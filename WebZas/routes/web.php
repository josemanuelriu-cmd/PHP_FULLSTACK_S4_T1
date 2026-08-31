<?php

use App\Models\Zassessions;
use App\Http\Controllers\BoardgamesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\ZassessionsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use App\Http\Middleware\CheckUserActive;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/lang/{locale}', function ($locale) {
    
if (!in_array($locale, ['es','en','ca'])) {
        abort(400);
    }

    session(['locale' => $locale]);

    $user = Auth::user();
    if ($user) {
        $user->update([
           'language' => $locale
        ]);
    }
    return back();
})->name('lang.switch');


Route::bind('zassessions', function ($value) {
    return Zassessions::findOrFail($value);
});

Route::middleware(['auth','check.type:admin,junta,partner'])->group(function () {
    Route::resource('boardgames', BoardgamesController::class)
        ->except(['index','show']);     
    Route::resource('zassessions', ZassessionsController::class)
        ->parameters(['zassessions' => 'zassessions'])
        ->except(['index','show']);
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

Route::middleware(['auth','check.type:admin'])->group(function () {
    Route::patch('/profile/zas/{user}/deactivate', [ProfileController::class, 'deactivate'])
        ->name('profile.zas.deactivate');
    Route::patch('/profile/zas/{user}/reactivate', [ProfileController::class, 'reactivate'])
        ->name('profile.zas.reactivate');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/zassessions', [ZassessionsController::class, 'index'])
        ->name('zassessions.index');
    Route::get('/zassessions/{zassessions}', [ZassessionsController::class, 'show'])
        ->name('zassessions.show');
    Route::get('/boardgames', [BoardgamesController::class, 'index'])
        ->name('boardgames.index');
    Route::get('/boardgames/{boardgame}', [BoardgamesController::class, 'show'])
        ->name('boardgames.show');
    Route::post('/zassessions/{zassession}/join', [ZassessionsController::class, 'join'])
        ->name('zassessions.join');
    Route::post('/zassessions/{zassession}/externaljoin', [ZassessionsController::class, 'externaljoin'])
        ->name('zassessions.externaljoin');
    Route::delete('/zassessions/{zassession}/leave', [ZassessionsController::class, 'leave'])
        ->name('zassessions.leave');
    Route::get('/zassessions/{zassession}/games/{game}', [GamesController::class, 'show'])
        ->name('games.show');
    Route::post('/zassessions/{zassession}/games/{game}/join', [GamesController::class, 'join'])
        ->name('games.join');
    Route::delete('/zassessions/{zassession}/games/{game}/leave', [GamesController::class, 'leave'])
        ->name('games.leave');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/zas/{user?}', [ProfileController::class, 'editZas'])->name('profile.zas.edit');
    Route::patch('/profile/zas/{user?}', [ProfileController::class, 'updateZas'])->name('profile.zas.update');
    Route::post('/profile/theme', [ProfileController::class, 'updateTheme'])->name('profile.theme.update');
    
    Route::fallback(function () {
        return response()->view('errors.404', [], 404);
    });
    Route::get('/post/{id}', [PostController::class, 'show']);    
});
Route::middleware(['auth','check.type:admin'])->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth','check.type:admin,junta'])->group(function () {
    Route::resource('types', TypesController::class);    
});

require __DIR__.'/auth.php';
