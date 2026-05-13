<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // admin usage only, td: new page to come
    /* public function index(){
        return view('category.index', ['categories' => Category::all()]);
    }

    public function create(){
        return view('category.create');
    }

    public function store(Request $request){
        Category::create($request->all());
        return redirect('/category');
    } */
}
