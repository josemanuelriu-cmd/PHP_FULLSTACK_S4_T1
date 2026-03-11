<?php

use App\Models\Zassessions;
use App\Http\Controllers\BoardGamesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\ZassessionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

// Binding manual para Zassessions
Route::bind('zassessions', function ($value) {
    return Zassessions::findOrFail($value);
});

// Ruta principal
Route::get('/', function () {
    return redirect()->route('boardgames.index');
});

// Rutas que requieren autenticación
Route::middleware('auth')->group(function () {

    // admin: CRUD usuarios
    Route::middleware('check.type:admin')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // admin y junta: CRUD tipos, juegos y sessiones
    Route::middleware('check.type:admin,junta')->group(function () {
        Route::resource('types', TypesController::class);        
    });

    // admin, junta y partner: ver tipos, juegos, sessiones, partidas, crear partidas
    Route::middleware('check.type:admin,junta,partner')->group(function () {   
        Route::resource('boardgames', BoardGamesController::class);     
        Route::resource('zassessions', ZassessionsController::class)
            ->parameters(['zassessions' => 'zassessions']);
        Route::get('/zassessions/{zassession}/games/create', [GamesController::class, 'create'])
            ->name('games.create');
        Route::post('/zassessions/{zassession}/games', [GamesController::class, 'store']
            )->name('games.store');
    });

    // todos los usuarios: Apuntarse/borrarse de una sesión
    Route::post('/zassessions/{zassession}/join', [ZassessionsController::class, 'join'])
        ->name('zassessions.join');
    Route::delete('/zassessions/{zassession}/leave', [ZassessionsController::class, 'leave'])
        ->name('zassessions.leave');
});

/*
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

Route::middleware(['auth'])->group(function () {
    Route::post('/zassessions/{zassession}/join', [ZassessionsController::class, 'join'])
        ->name('zassessions.join');

    Route::delete('/zassessions/{zassession}/leave', [ZassessionsController::class, 'leave'])
        ->name('zassessions.leave');
});
*/
require __DIR__.'/auth.php';
