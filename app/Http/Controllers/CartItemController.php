<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\GameVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function index()
    {
        $items = CartItem::where([
            'user_id' => Auth::user()->id
        ])->get();

        return view('frontend.cart.index', [
            'items' => $items
        ]);
    }

    public function store(Request $request, GameVersion $gameVersion)
    {
        $item = CartItem::where([
            'game_version_id' => $gameVersion->id,
            'user_id' => Auth::user()->id,
        ])->first();

        if($item){
            $item->update([
                'units' => $item->units + 1
            ]);
        }else{
            CartItem::create([
                'game_version_id' => $gameVersion->id,
                'user_id' => Auth::user()->id,
                'units' => 1,
            ]);
        }

        return redirect('/cart');
    }

    public function delete(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect('/cart');
    }
}