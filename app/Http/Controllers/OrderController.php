<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(){
        //pego os produtos
        $items = CartItem::where(
            ['user_id' => Auth::user()->id]
        )->get();

        //Calcula o total
        $total = 0;
        foreach($items as $i){
            $total += $i->units * $i->Product->price;
        }

        //crio o pedido
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total' => $total
        ]);

        foreach($items as $i){
            OrderItem::create([
                'product_id' => $i->product_id,
                'units' => $i->units,
                'price' => $i->Product->price,
                'order_id' => $order->id
            ]);
            $i->delete();
        }

        return redirect('/order');
    }

    public function index(){
        //Pegar todos os pedidos
        $orders = Order::where(
            ['user_id' => Auth::user()->id]
        )->get();

        return view('order.index', ['orders'=>$orders]);
    }
}
