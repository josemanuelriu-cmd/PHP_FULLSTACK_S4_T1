<?php

use App\Models\Sessions_zas;
use App\Http\Controllers\BoardGamesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\Sessions_zasController;
use App\Http\Controllers\ProfileController;
use App\Models\Boardgames;
use Illuminate\Support\Facades\Route;

// Binding manual para sessions_zas, para evitar que el binding automático busque por id. En su lugar, buscará por el campo que se le indique (en nuestro caso, 'date').
Route::bind('sessions_zas', function ($value) {
    return Sessions_zas::findOrFail($value);
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
    Route::resource('sessions_zas', Sessions_zasController::class)
    ->parameters(['sessions_zas' => 'sessions_zas'
    ]);        
});


Route::get('prueba', function () {
    $boardgames = Boardgames::find(1);
    //devuelve el juego 1
    //return $boardgames;

    //añadir tipos con attach
    $boardgames->types()->attach([10,12]);

    $boardgames = Boardgames::find(2);
    $boardgames->types()->attach([5,10]);

    //quitar tipos con detach
    //$boardgames->types()->detach([12]);

    //elimina todas los tipos anteriores y me añade estos; detach de todo + attach de lo nuevo
    //$boardgames->types()->sync([9,12]);

    //devuelve los tipos de ese juego
    //return $boardgames->types;
});

require __DIR__.'/auth.php';
