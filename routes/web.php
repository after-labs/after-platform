<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('frontend/home');
    })->name('dashboard');

    Route::get('/games', function () {
        return view('frontend/games/catalog');
    })->name('games.catalog');

    Route::get('/games/{game}', function ($game) {
        return view('frontend/games/show', ['gameSlug' => $game]);
    })->name('games.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
