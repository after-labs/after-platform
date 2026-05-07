<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameVersion;
use App\Models\Category;

class GameVersionController extends Controller
{
    public function index(){
        // td: uso de condicional de admin logado para redirecionar a outra view
        return view('frontend.games.catalog', ['games' => GameVersion::all()]);
    }

    public function categorize(Request $request, String $category){
        // td: the request object is the data itself or a object with a field for the data inside? 
        $categoryRow = Category::where(['name' => $category]);
        $games = GameVersion::where(['category_id' => $categoryRow->id]);
        return view('frontend.games.catalog_type', ['category' => $category, 'games'=> $games]);
    }
}
