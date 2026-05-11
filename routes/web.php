<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistItemController;



// Public/guest Routes

Route::get('/', [GameController::class, 'home'])->name('home');

Route::redirect('/dashboard', '/')
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/games', [GameController::class, 'index'])->name('games.index');

Route::get('/games/show/{game}', [
    GameController::class,
    'show'
])->name('games.show');

Route::get('/games/category/{category}', [
    GameController::class,
    'category'
])->name('games.category');

Route::get('lang/{locale}', function ($locale) {

    if(in_array($locale, ['en', 'pt'])){
        session(['locale' => $locale]);
    }

    return redirect()->back();

})->name('lang.switch');



// Client

Route::middleware(['auth'])->group(function(){

    Route::get('/account', [
        ProfileController::class,
        'edit'
    ])->name('account');

    // Cart

    Route::get('/cart', [
        CartItemController::class,
        'index'
    ])->name('cart.index');

    Route::post('/cart/store/{gameVersion}', [
        CartItemController::class,
        'store'
    ])->name('cart.store');

    Route::post('/cart/delete/{cartItem}', [
        CartItemController::class,
        'delete'
    ])->name('cart.delete');

    Route::post('/cart/increase/{cartItem}', [
        CartItemController::class,
        'increase'
    ])->name('cart.increase');

    Route::post('/cart/decrease/{cartItem}', [
        CartItemController::class,
        'decrease'
    ])->name('cart.decrease');

    // Orders

    Route::get('/orders', [
        OrderController::class,
        'index'
    ])->name('orders.index');

    Route::get('/orders/checkout', [
        OrderController::class,
        'checkout'
    ])->name('orders.checkout');

    Route::post('/orders/checkout', [
        OrderController::class,
        'store'
    ])->name('orders.store');

    Route::get('/orders/completed/{order}', [
        OrderController::class,
        'completed'
    ])->name('orders.completed');

    // Wishlist

    Route::get('/wishlist', [
        WishlistItemController::class,
        'index'
    ])->name('wishlist.index');

    Route::post('/wishlist/store/{game}', [
        WishlistItemController::class,
        'store'
    ])->name('wishlist.store');

    Route::post('/wishlist/delete/{wishlistItem}', [
        WishlistItemController::class,
        'delete'
    ])->name('wishlist.delete');

    // Profile

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');

});

// Admin

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function(){

    Route::redirect('/', '/admin/games')->name('dashboard');

    // Users

    Route::get('/users', [
        UserController::class,
        'index'
    ])->name('users.index');

    Route::get('/users/create', [
        UserController::class,
        'create'
    ])->name('users.create');

    Route::post('/users/store', [
        UserController::class,
        'store'
    ])->name('users.store');

    Route::get('/users/edit/{user}', [
        UserController::class,
        'edit'
    ])->name('users.edit');

    Route::post('/users/update/{user}', [
        UserController::class,
        'update'
    ])->name('users.update');

    Route::get('/users/delete/{user}', [
        UserController::class,
        'delete'
    ])->name('users.delete');

    // Games

    Route::get('/games', [
        GameController::class,
        'adminIndex'
    ])->name('games.index');

    Route::get('/games/create', [
        GameController::class,
        'create'
    ])->name('games.create');

    Route::post('/games/store', [
        GameController::class,
        'store'
    ])->name('games.store');

    Route::get('/games/edit/{game}', [
        GameController::class,
        'edit'
    ])->name('games.edit');

    Route::post('/games/update/{game}', [
        GameController::class,
        'update'
    ])->name('games.update');

    Route::get('/games/delete/{game}', [
        GameController::class,
        'delete'
    ])->name('games.delete');

});


require __DIR__.'/auth.php';
