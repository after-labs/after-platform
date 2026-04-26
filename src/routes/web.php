<?php

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

// Guest Page Test Route

Route::get('/home_guest', function () {
    return view('home_guest');
});

// Client Pages Test Routes

Route::get('/home_client', function () {
    return view('frontend.home');
});

Route::get('/catalog', function () {
    return view('frontend.games.catalog');
});

Route::get('/catalog_type', function () {
    return view('frontend.games.catalog_type');
});

Route::get('/game_show', function () {
    return view('frontend.games.show');
});

Route::get('/account', function () {
    return view('frontend.account.account');
});



// Auth Pages Test Routes

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/signup', function () {
    return view('auth.signup');
});
Route::get('/reset_password', function () {
    return view('auth.reset_password');
});
Route::get('/verify_code', function () {
    return view('auth.verify_code');
});
Route::get('/new_password', function () {
    return view('auth.new_password');
});

// Admin Pages Test Routes

Route::get('/admin_orders', function () {
    return view('backend.orders');
});

Route::get('/admin_users', function () {
    return view('backend.users');
});

Route::get('/admin_users_create', function () {
    return view('backend.users.create');
});

Route::get('/admin_users_edit', function () {
    return view('backend.users.edit');
});

Route::get('/admin_games', function () {
    return view('backend.games');
});

Route::get('/admin_games_create', function () {
    return view('backend.games.create');
});

Route::get('/admin_games_edit', function () {
    return view('backend.games.edit');
});