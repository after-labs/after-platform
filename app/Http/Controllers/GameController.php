<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function home()
    {
        $baseQuery = Game::with([
            'media',
            'versions.offer',
            'category',
        ]);

        $popularGames = (clone $baseQuery)
            ->where('featured', true)
            ->latest()
            ->limit(6)
            ->get();

        if ($popularGames->isEmpty()) {
            $popularGames = (clone $baseQuery)
                ->latest()
                ->limit(6)
                ->get();
        }

        $freeGames = (clone $baseQuery)
            ->whereHas('versions', function ($query) {
                $query->where('active', true)
                    ->where('final_price', 0);
            })
            ->limit(6)
            ->get();

        if ($freeGames->isEmpty()) {
            $freeGames = (clone $baseQuery)
                ->latest()
                ->limit(6)
                ->get();
        }

        $onSaleGames = (clone $baseQuery)
            ->whereHas('versions', function ($query) {
                $query->whereColumn('final_price', '<', 'base_price');
            })
            ->limit(6)
            ->get();

        if ($onSaleGames->isEmpty()) {
            $onSaleGames = (clone $baseQuery)
                ->latest()
                ->limit(6)
                ->get();
        }

        $highlightGame = $onSaleGames->first()
            ?? $popularGames->first()
            ?? $freeGames->first();

        return view('frontend.home', compact(
            'popularGames',
            'freeGames',
            'onSaleGames',
            'highlightGame'
        ));
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $games = Game::with([
            'media',
            'versions.offer',
            'category'
        ])
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%");
        })
        ->paginate(12)
        ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('frontend.games.catalog', compact(
            'games',
            'search',
            'categories'
        ));
    }

    public function category(Category $category)
    {
        $games = Game::with([
            'media',
            'versions.offer',
            'category'
        ])
        ->where('category_id', $category->id)
        ->paginate(12)
        ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('frontend.games.catalog_type', compact(
            'games',
            'category',
            'categories'
        ));
    }

    public function show(Game $game)
    {
        $game->load([
            'media',
            'versions.platform',
            'versions.offer',
            'genres',
            'category'
        ]);

        $relatedGames = Game::with([
            'media',
            'versions.offer'
        ])
        ->where('category_id', $game->category_id)
        ->where('id', '!=', $game->id)
        ->limit(6)
        ->get();

        return view('frontend.games.show', compact(
            'game',
            'relatedGames'
        ));
    }
}
