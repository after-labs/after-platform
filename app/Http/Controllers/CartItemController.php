<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function delete(){
        $items = CartItem::where(['user_id' => Auth::user()->id])->first();
        $items->delete();
        return redirect('/cart'); // td: caminho do web.php, reajustar
    }

    public function index(){
        $items = CartItem::where(['user_id' => Auth::user()->id])->get();
        return view('frontend.cart.index', ['items' => $items]);
    }

    public function store(Request $request, GameVersion $game){
        $item = CartItem::where([
                'game_version_id' => $game->id,
                'user_id' => Auth::user()->id,
        ])->first();
        
        if($item){
            $item->update(['units' => $item->units+1]);
        }else{
            CartItem::create([
                'game_id' => $game->id,
                'user_id' => Auth::user()->id,
                'units' => 1,
            ]);
        }
        return redirect('/cart');
    }
}
