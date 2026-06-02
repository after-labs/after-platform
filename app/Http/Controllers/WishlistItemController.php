<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;

class WishlistItemController extends Controller
{
    public function index()
    {
        $items = WishlistItem::with([
            'Game.media',
            'Game.versions.offer',
            'Game.category',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.account.wishlist', compact('items'));
    }

    public function store(Game $game)
    {
        WishlistItem::firstOrCreate([
            'user_id' => Auth::id(),
            'game_id' => $game->id,
        ]);

        Auth::user()->notifications()->create([
            'title' => 'Jogo salvo na wishlist',
            'description' => $game->name.' foi salvo na sua wishlist.',
        ]);

        return redirect()->route('wishlist.index');
    }

    public function delete(WishlistItem $wishlistItem)
    {
        abort_unless($wishlistItem->user_id === Auth::id(), 403);

        $wishlistItem->delete();

        return redirect()->route('wishlist.index');
    }
}
