<?php

use App\Models\Sessions_zas;
use App\Models\Zassessions;
use App\Http\Controllers\BoardGamesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\Sessions_zasController;
use App\Http\Controllers\ZassessionsController;
use App\Http\Controllers\ProfileController;
use App\Models\Boardgames;
use Illuminate\Support\Facades\Route;

// Binding manual para sessions_zas, para evitar que el binding automático busque por id. En su lugar, buscará por el campo que se le indique (en nuestro caso, 'date').
Route::bind('zassessions', function ($value) {
    return Zassessions::findOrFail($value);
});

Route::get('/', function () {
    return redirect()->route('boardgames.index');
    //return redirect()->route('auth.login');
});

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
    Route::resource('zassessions', ZassessionsController::class)
    ->parameters(['zassessions' => 'zassessions'
    ]);        
});

require __DIR__.'/auth.php';
