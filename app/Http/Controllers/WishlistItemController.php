<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\WishlistItem;
use Illuminate\Http\Request;

class WishlistItemController extends Controller
{
    public function index(Request $request)
    {
        $items = $request->user()
            ->wishlistItems()
            ->with([
                'game.media',
                'game.versions.offer',
                'game.category',
            ])
            ->latest()
            ->get();

        return view('frontend.account.wishlist', compact('items'));
    }

    public function store(Request $request, Game $game)
    {
        $request->user()->wishlistItems()->firstOrCreate([
            'game_id' => $game->id,
        ]);

        $request->user()->notifications()->create([
            'title' => 'Game saved to wishlist',
            'description' => $game->name.' was saved to your wishlist.',
        ]);

        return redirect()->route('wishlist.index');
    }

    public function delete(Request $request, WishlistItem $wishlistItem)
    {
        $wishlistItem->loadMissing('user');

        abort_unless($wishlistItem->user->is($request->user()), 403);

        $wishlistItem->delete();

        return redirect()->route('wishlist.index');
    }
}
