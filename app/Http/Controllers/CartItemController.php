<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\GameVersion;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index(Request $request)
    {
        $items = $request->user()
            ->cartItems()
            ->with([
                'gameVersion.game.media',
                'gameVersion.platform',
                'gameVersion.offer',
            ])
            ->get();

        $total = $items->sum(fn (CartItem $item) => $item->units * $item->gameVersion->final_price);

        return view('frontend.cart.index', [
            'items' => $items,
            'total' => $total,
        ]);
    }

    public function store(Request $request, GameVersion $gameVersion)
    {
        abort_unless($gameVersion->active, 404);

        $gameVersion->load('game');

        $item = $request->user()->cartItems()->firstOrNew([
            'game_version_id' => $gameVersion->id,
        ]);

        $item->units = $item->exists ? $item->units + 1 : 1;
        $item->save();

        $request->user()->notifications()->create([
            'title' => 'Game added to cart',
            'description' => $gameVersion->game->name.' was added to your cart.',
        ]);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request, CartItem $cartItem)
    {
        $cartItem->loadMissing('user');

        abort_unless($cartItem->user->is($request->user()), 403);

        $cartItem->delete();

        return redirect()->route('cart.index');
    }

    public function increase(Request $request, CartItem $cartItem)
    {
        $cartItem->loadMissing('user');

        abort_unless($cartItem->user->is($request->user()), 403);

        $cartItem->update([
            'units' => $cartItem->units + 1,
        ]);

        return redirect()->route('cart.index');
    }

    public function decrease(Request $request, CartItem $cartItem)
    {
        $cartItem->loadMissing('user');

        abort_unless($cartItem->user->is($request->user()), 403);

        if ($cartItem->units <= 1) {
            $cartItem->delete();
        } else {
            $cartItem->update([
                'units' => $cartItem->units - 1,
            ]);
        }

        return redirect()->route('cart.index');
    }
}
