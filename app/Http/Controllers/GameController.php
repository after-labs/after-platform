<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    /* public function index(){
        // td: uso de condicional de admin logado para redirecionar a outra view
        return view('frontend.games.catalog', ['games' => GameVersion::all()]);
    }

    public function types(Request $category){
        // td: the request object is the data itself or a object with a field for the data inside? 
        $categoryRow = Category::where['name' => $category];
        $games = GameVersion::where['category_id' => $categoryRow->id]
        return view('frontend.games.catalog_type', ['category' => $category, 'games'=> $games]);
    }

    public function create(){
        // admin exclusive 
        return view('backend.game.create');
    }

    public function store(Request $request){
        $game = Game::create($request->all());
        GameMedia::create([
            'game_id' => $game->id,
            'url' => $request['img_01'],
            'order' => 0
        ]);
        GameMedia::create([
            'game_id' => $game->id,
            'url' => $request['img_02'],
            'order' => 1
        ]);
        GameMedia::create([
            'game_id' => $game->id,
            'url' => $request['img_03'],
            'order' => 2
        ]);

        $product->Tags()->sync($request['tags_id']);

        return redirect('/game');
    }

    public function show(Game $game){
        // td: admin conditional usage - see with Quintas if its the best approach or if a new function should be created to split logic
        return view('game.show', ['game'=>$game]);
    } */
}
