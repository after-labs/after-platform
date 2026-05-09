<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $items = $this->cartItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('status', 'empty-cart');
        }

        return view('frontend.orders.checkout', [
            'items' => $items,
            'total' => $this->cartTotal($items),
        ]);
    }

    public function store()
    {
        $items = $this->cartItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('status', 'empty-cart');
        }

        $order = DB::transaction(function () use ($items) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $this->cartTotal($items),
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'game_version_id' => $item->game_version_id,
                    'units' => $item->units,
                    'price' => $item->gameVersion->final_price,
                    'order_id' => $order->id,
                ]);

                $item->delete();
            }

            return $order;
        });

        return redirect()->route('orders.completed', $order);
    }

    public function completed(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);

        $order->load([
            'items.gameVersion.game.media',
            'items.gameVersion.platform',
        ]);

        return view('frontend.orders.completed', compact('order'));
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
}
