<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameVersionController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('lang/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'pt'])) {
        session(['locale' => $locale]);
    }
    return redirect(url()->previous('/'));
})->name('lang.switch');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('frontend/home');
    });

    Route::get('/account', function () {
        return view('account');
    })->name('dashboard');
    
    Route::get('/games', [GameVersionController::class, 'index']);
    Route::get('/games/show/{game}',[GameVersionController::class, 'show']);
    Route::get('/games/{category}', [GameController::class, 'categorize']);
    /*
    Route::get('/cart', [CartItemController::class, 'index']);
    Route::get('/checkout/{cartItems}',[OrderController::class, 'checkout']);
    Route::get('/', [OrderController::class, 'types']);

    Route::post('/cart/store/{product}', [CartItemController::class, 'store']);
    Route::get('/cart', [CartItemController::class, 'index']);
    Route::get('/cart/delete/{product}', [CartItemController::class, 'delete']);
    Route::get('/order/checkout', [OrderController::class, 'checkout']);
    Route::get('/order', [OrderController::class, 'index']);
    */ 

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// admin routes zone
/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/store', [ProductController::class, 'store']);
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category/store', [CategoryController::class, 'store']);
    Route::get('/tag/create', [TagController::class, 'create']);
    Route::post('/tag/store', [TagController::class, 'store']);
    }); */

require __DIR__.'/auth.php';