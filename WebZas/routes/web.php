<?php

use App\Models\Zassessions;
use App\Http\Controllers\BoardGamesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\ZassessionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PostController;
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
        Route::post('/zassessions/{zassession}/games', [GamesController::class, 'store'])
            ->name('games.store');
        Route::get('/zassessions/{zassession}/games/{game}/edit', [GamesController::class, 'edit'])
            ->name('games.edit');
        Route::delete('/zassessions/{zassession}/games/{game}/destroy', [GamesController::class, 'destroy'])
            ->name('games.destroy');
        Route::get('/zassessions/{zassession}/games/{game}/close', [GamesController::class, 'close'])
            ->name('games.close');
        Route::get('/zassessions/{zassession}/games/{game}/reopen', [GamesController::class, 'reopen'])
            ->name('games.reopen');
        Route::put('/zassessions/{zassession}/games/{game}/update', [GamesController::class, 'update'])
            ->name('games.update');
    });

    // todos los usuarios: Apuntarse/borrarse de una sesión, apuntarse a partidas
    Route::post('/zassessions/{zassession}/join', [ZassessionsController::class, 'join'])
        ->name('zassessions.join');
    Route::delete('/zassessions/{zassession}/leave', [ZassessionsController::class, 'leave'])
        ->name('zassessions.leave');
    Route::get('/zassessions/{zassession}/games/{game}', [GamesController::class, 'show'])
        ->name('games.show');
    Route::post('/zassessions/{zassession}/games/{game}/join', [GamesController::class, 'join'])
        ->name('games.join');
    Route::delete('/zassessions/{zassession}/games/{game}/leave', [GamesController::class, 'leave'])
        ->name('games.leave');
    Route::fallback(function () {
        return response()->view('errors.404', [], 404);
    });

    Route::get('/post/{id}', [PostController::class, 'show']);
    
});


require __DIR__.'/auth.php';
