<?php

use App\Http\Controllers\FruitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FruitController::class,'fruits'])->name('home');

Route::prefix('fruits')->group(function () {
    Route::get('/', [FruitController::class,'fruits'])->name('fruits');
    Route::patch('/', [FruitController::class,'addToFavorites'])->name('favorite.add');
    Route::delete('/', [FruitController::class,'removeFromFavorites'])->name('favorite.remove');

    Route::get('favorites', [FruitController::class,'favoriteFruits'])->name('favorite.fruits');
});

