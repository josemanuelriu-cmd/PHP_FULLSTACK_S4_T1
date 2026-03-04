<?php

use App\Http\Controllers\BoardGamesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\Sessions_zasController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('boardgames.index');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('boardgames', BoardGamesController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('types', TypesController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('sessions_zas', Sessions_zasController::class)
    ->parameters(['sessions_zas' => 'sessions_zas'
    ]);        
});

require __DIR__.'/auth.php';
