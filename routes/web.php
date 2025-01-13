<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Recommend_MeController;
use App\Http\Controllers\Recommend_OtherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('/movie-page', MovieController::class)->middleware(['auth', 'verified'])->names('movie-page');
Route::resource('/recommend-other', Recommend_OtherController::class)->middleware(['auth', 'verified'])->names('recommend-other');
Route::resource('/recommend-me', Recommend_MeController::class)->middleware(['auth', 'verified'])->names('recommend-me');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
