<?php

namespace App\Http\Controllers;

use App\Models\AccessKey;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use UnexpectedValueException;

class OrderController extends Controller
{
    public function checkout()
    {
        $items = $this->cartItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('status', 'empty-cart');
        }

        $gamification = Auth::user()->gamification;

        return view('frontend.orders.checkout', [
            'items' => $items,
            'subtotal' => $this->cartTotal($items),
            'availableCoins' => $gamification?->coins ?? 0,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => ['nullable', 'string', 'max:50'],
            'coins_used' => ['nullable', 'integer', 'min:0'],
        ]);

        $items = $this->cartItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('status', 'empty-cart');
        }

        $user = Auth::user();
        $gamification = $user->gamification ?: $user->gamification()->create([
            'level' => 1,
            'points' => 0,
            'coins' => 0,
        ]);
        $totals = $this->totals($items, $request, (int) ($gamification->coins ?? 0));

        if ($totals['error']) {
            return back()->withInput()->withErrors($totals['error']);
        }

        $order = DB::transaction(function () use ($items, $user, $totals) {
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending',
                'subtotal' => $totals['subtotal'],
                'coupon_code' => $totals['coupon']?->code,
                'coupon_discount' => $totals['couponDiscount'],
                'coins_used' => $totals['coinsUsed'],
                'coin_discount' => $totals['coinDiscount'],
                'total' => $totals['total'],
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'game_version_id' => $item->game_version_id,
                    'units' => $item->units,
                    'price' => $item->gameVersion->final_price,
                    'order_id' => $order->id,
                ]);
            }

            return $order;
        });

        // Go complete the order without stripe integration if the total value is 0. 
        /* if ($order->total <= 0) {
            $this->completeOrder($order);

            return redirect()->route('orders.success', $order);
        } */

        if (! config('services.stripe.secret')) {
            return redirect()->route('orders.error', $order)
                ->with('payment_error', 'Stripe is not configured.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $session = Session::create([
                'mode' => 'payment',
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => config('services.stripe.currency', 'usd'),
                        'unit_amount' => (int) round($order->total * 100),
                        'product_data' => [
                            'name' => 'After order #'.str_pad($order->id, 6, '0', STR_PAD_LEFT),
                        ],
                    ],
                ]],
                'metadata' => [
                    'order_id' => $order->id,
                ],
                'success_url' => route('orders.success', $order).'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('orders.error', $order),
            ]);
        } catch (\Throwable $exception) {
            return redirect()->route('orders.error', $order)
                ->with('payment_error', 'Stripe checkout could not be created.');
        }

        $order->update([
            'stripe_checkout_session_id' => $session->id,
        ]);

        return redirect($session->url);
    }

    public function success(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        if ($order->status === 'pending' && ! request()->has('session_id')) {
            return redirect()->route('orders.error', $order);
        }

        $order->load([
            'items.gameVersion.game.media',
            'items.gameVersion.platform',
            'accessKeys.game',
            'accessKeys.gameVersion.platform',
        ]);

        return view('frontend.orders.success', compact('order'));
    }

    public function error(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        return view('frontend.orders.error', compact('order'));
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $secret = config('services.stripe.webhook_secret');

        if ($secret) {
            try {
                $event = Webhook::constructEvent($payload, $request->header('Stripe-Signature'), $secret);
            } catch (UnexpectedValueException|SignatureVerificationException) {
                return response('Invalid webhook', 400);
            }
        } else {
            $event = json_decode($payload);
        }

        if (! $event || $event->type !== 'checkout.session.completed') {
            return response('OK');
        }

        $session = $event->data->object;
        $orderId = $session->metadata->order_id ?? null;
        $order = Order::find($orderId);

        if (! $order) {
            return response('Order not found', 404);
        }

        if ($order->status !== 'paid') {
            $order->update([
                'stripe_checkout_session_id' => $session->id,
                'stripe_payment_intent_id' => $session->payment_intent ?? null,
            ]);

            $this->completeOrder($order);
        }

        return response('OK');
    }

    public function completed(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        if ($order->status === 'pending') {
            return redirect()->route('orders.error', $order);
        }

        return redirect()->route('orders.success', $order);
    }

    public function index()
    {
        $orders = Order::with([
            'items.gameVersion.game',
            'items.gameVersion.platform',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.orders.index', [
            'orders' => $orders
        ]);
    }

    private function cartItems()
    {
        return CartItem::with([
            'gameVersion.game.media',
            'gameVersion.platform',
            'gameVersion.offer',
        ])
            ->where('user_id', Auth::id())
            ->get();
    }

    private function cartTotal($items): float
    {
        return $items->sum(function ($item) {
            return $item->units * $item->gameVersion->final_price;
        });
    }

    private function totals($items, Request $request, int $availableCoins): array
    {
        $subtotal = $this->cartTotal($items);
        $coupon = null;
        $couponDiscount = 0;
        $code = strtoupper(trim((string) $request->input('coupon_code')));

        if ($code !== '') {
            $coupon = Coupon::where('code', $code)->first();

            if (! $coupon || ! $coupon->isAvailable()) {
                return ['error' => ['coupon_code' => 'Cupom inválido ou indisponível.']];
            }

            $couponDiscount = round($subtotal * ($coupon->discount_percent / 100), 2);
        }

        $afterCoupon = max(0, $subtotal - $couponDiscount);
        $coinsUsed = (int) $request->input('coins_used', 0);

        if ($coinsUsed > $availableCoins) {
            return ['error' => ['coins_used' => 'Você não possui moedas suficientes.']];
        }

        $maxCoins = (int) floor($afterCoupon * 100);
        $coinsUsed = min($coinsUsed, $maxCoins);
        $coinDiscount = round($coinsUsed / 100, 2);

        return [
            'error' => null,
            'subtotal' => $subtotal,
            'coupon' => $coupon,
            'couponDiscount' => $couponDiscount,
            'coinsUsed' => $coinsUsed,
            'coinDiscount' => $coinDiscount,
            'total' => max(0, round($afterCoupon - $coinDiscount, 2)),
        ];
    }

    private function completeOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $order->refresh();

            if ($order->status === 'paid') {
                return;
            }

            $order->load([
                'items.gameVersion.game',
                'items.gameVersion.platform',
                'user.gamification',
            ]);

            foreach ($order->items as $item) {
                $availableKeys = AccessKey::where('game_version_id', $item->game_version_id)
                    ->where('status', 'available')
                    ->count();

                if ($availableKeys < $item->units) {
                    $order->update([
                        'status' => 'missing_keys',
                        'paid_at' => now(),
                    ]);

                    $order->user->notifications()->create([
                        'title' => 'Pedido pago',
                        'description' => 'Seu pagamento foi confirmado, mas algumas chaves ainda precisam ser liberadas.',
                    ]);

                    return;
                }
            }

            foreach ($order->items as $item) {
                $keys = AccessKey::where('game_version_id', $item->game_version_id)
                    ->where('status', 'available')
                    ->limit($item->units)
                    ->get();

                foreach ($keys as $key) {
                    $key->update([
                        'order_id' => $order->id,
                        'status' => 'sold',
                        'sold_at' => now(),
                    ]);
                }
            }

            if ($order->coupon_code) {
                Coupon::where('code', $order->coupon_code)->increment('times_used');
            }

            if ($order->coins_used > 0) {
                $order->user->gamification()->decrement('coins', $order->coins_used);
            }

            CartItem::where('user_id', $order->user_id)->delete();

            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
                'fulfilled_at' => now(),
            ]);

            $this->rewardUser($order);

            $order->user->notifications()->create([
                'title' => 'Pedido concluído',
                'description' => 'Seu pedido #'.str_pad($order->id, 6, '0', STR_PAD_LEFT).' foi pago e suas chaves foram enviadas.',
            ]);
        });

        $this->sendKeysEmail($order);
    }

    private function rewardUser(Order $order): void
    {
        $gamification = $order->user->gamification()->first() ?: $order->user->gamification()->create([
            'level' => 1,
            'points' => 0,
            'coins' => 0,
        ]);
        $points = (int) floor($order->total * 10);

        if ($points <= 0) {
            return;
        }

        $gamification->points += $points;

        while ($gamification->points >= $gamification->level * 100) {
            $gamification->points -= $gamification->level * 100;
            $gamification->level += 1;
            $gamification->coins += 100;
        }

        $gamification->save();
    }

    private function sendKeysEmail(Order $order): void
    {
        $order->load([
            'user',
            'accessKeys.game',
            'accessKeys.gameVersion.platform',
        ]);

        if ($order->accessKeys->isEmpty()) {
            return;
        }

        $lines = $order->accessKeys->map(function ($key) {
            return $key->game->name.' - '.$key->gameVersion->platform->name.': '.$key->key;
        })->implode("\n");

        Mail::raw("Obrigado pela compra na After.\n\nSuas chaves:\n".$lines, function ($message) use ($order) {
            $message->to($order->user->email)
                ->subject('Suas chaves de acesso da After');
        });
    }
}
