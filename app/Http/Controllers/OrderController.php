<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /* ─────────────── FRONTEND ─────────────── */

    public function checkout()
    {
        $items = $this->cartItems();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('status', 'empty-cart');
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
            return redirect()->route('cart.index')->with('status', 'empty-cart');
        }

        $order = DB::transaction(function () use ($items) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total'   => $this->cartTotal($items),
                'status'  => 'in_progress',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'game_version_id' => $item->game_version_id,
                    'units'           => $item->units,
                    'price'           => $item->gameVersion->final_price,
                    'order_id'        => $order->id,
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

        return view('frontend.orders.index', compact('orders'));
    }

    /* ─────────────── ADMIN ─────────────── */

    public function adminIndex(Request $request)
    {
        $query = Order::with([
            'user',
            'items.gameVersion.game',
            'items.gameVersion.platform',
        ]);

        // Busca por ID, nome ou e-mail
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('id', $s)
                  ->orWhereHas('user', fn($u) =>
                      $u->where('name',  'like', "%{$s}%")
                        ->orWhere('email', 'like', "%{$s}%")
                  );
            });
        }

        // Filtros de status
        match ($request->input('filter', 'all')) {
            'in_progress' => $query->where('status', 'in_progress'),
            'completed'   => $query->where('status', 'completed'),
            'refused'     => $query->where('status', 'refused'),
            'today'       => $query->whereDate('created_at', today()),
            'week'        => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]),
            'month'       => $query->whereYear('created_at', now()->year)->whereMonth('created_at', now()->month),
            default       => null,
        };

        $totalOrders = Order::count();
        $orders      = $query->latest()->paginate(10)->withQueryString();

        return view('backend.orders.index', compact('orders', 'totalOrders'));
    }

    // Atualiza status de um pedido via AJAX (inline)
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:in_progress,completed,refused'],
        ]);

        $order->update(['status' => $request->status]);

        return response()->json(['ok' => true, 'status' => $order->status]);
    }

    /* ─────────────── HELPERS ─────────────── */

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
        return $items->sum(fn($item) => $item->units * $item->gameVersion->final_price);
    }
}