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
        $items = CartItem::with([
            'gameVersion.game.media',
            'gameVersion.platform',
            'gameVersion.offer',
        ])
            ->where('user_id', Auth::id())
            ->get();

        $total = $items->sum(function ($item) {
            return $item->units * $item->gameVersion->final_price;
        });

        return view('frontend.cart.index', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function store(Request $request, GameVersion $gameVersion)
    {
        abort_unless($gameVersion->active, 404);

        $item = CartItem::where([
            'game_version_id' => $gameVersion->id,
            'user_id' => Auth::id(),
        ])->first();

        if($item){
            $item->update([
                'units' => $item->units + 1
            ]);
        }else{
            CartItem::create([
                'game_version_id' => $gameVersion->id,
                'user_id' => Auth::id(),
                'units' => 1,
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function delete(CartItem $cartItem)
    {
        abort_unless($cartItem->user_id === Auth::id(), 403);

        $cartItem->delete();

        return redirect()->route('cart.index');
    }
}
