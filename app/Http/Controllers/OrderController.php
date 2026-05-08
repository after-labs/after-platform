<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $items = CartItem::where([
            'user_id' => Auth::user()->id
        ])->get();

        $total = 0;

        foreach($items as $i){
            $total += $i->units * $i->GameVersion->final_price;
        }

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total' => $total
        ]);

        foreach($items as $i){
            OrderItem::create([
                'game_version_id' => $i->game_version_id,
                'units' => $i->units,
                'price' => $i->GameVersion->final_price,
                'order_id' => $order->id
            ]);

            $i->delete();
        }

        return redirect('/order');
    }

    public function index() {
        $orders = Order::where([
            'user_id' => Auth::user()->id
        ])->get();

        return view('frontend.orders.index', [
            'orders' => $orders
        ]);
    }
}

