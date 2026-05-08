<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;



// Public/guest Routes

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/games', [GameController::class, 'index']);

Route::get('/games/show/{game}', [
    GameController::class,
    'show'
]);

Route::get('/games/category/{category}', [
    GameController::class,
    'category'
]);

Route::get('lang/{locale}', function ($locale) {

    if(in_array($locale, ['en', 'pt'])){
        session(['locale' => $locale]);
    }

    return redirect()->back();

});



// Client

Route::middleware(['auth'])->group(function(){

    Route::get('/account', function () {
        return view('frontend.account.account');
    });

    // Cart

    Route::get('/cart', [
        CartItemController::class,
        'index'
    ]);

    Route::post('/cart/store/{gameVersion}', [
        CartItemController::class,
        'store'
    ]);

    Route::get('/cart/delete/{cartItem}', [
        CartItemController::class,
        'delete'
    ]);

    // Orders

    Route::get('/orders', [
        OrderController::class,
        'index'
    ]);

    Route::get('/orders/checkout', [
        OrderController::class,
        'checkout'
    ]);

    // Profile

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ]);

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ]);

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ]);

});

// Admin

Route::middleware(['auth', 'admin'])->group(function(){

    Route::get('/admin', function () {
        return view('backend.dashboard');
    });

    // Users

    Route::get('/users', [
        UserController::class,
        'index'
    ]);

    Route::get('/users/create', [
        UserController::class,
        'create'
    ]);

    Route::post('/users/store', [
        UserController::class,
        'store'
    ]);

    Route::get('/users/edit/{user}', [
        UserController::class,
        'edit'
    ]);

    Route::post('/users/update/{user}', [
        UserController::class,
        'update'
    ]);

    Route::get('/users/delete/{user}', [
        UserController::class,
        'delete'
    ]);

    // Games

    Route::get('/games', [
        GameController::class,
        'adminIndex'
    ]);

    Route::get('/games/create', [
        GameController::class,
        'create'
    ]);

    Route::post('/games/store', [
        GameController::class,
        'store'
    ]);

    Route::get('/games/edit/{game}', [
        GameController::class,
        'edit'
    ]);

    Route::post('/games/update/{game}', [
        GameController::class,
        'update'
    ]);

    Route::get('/games/delete/{game}', [
        GameController::class,
        'delete'
    ]);

});


require __DIR__.'/auth.php';