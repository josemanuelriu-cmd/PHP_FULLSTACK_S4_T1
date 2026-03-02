<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardgamesController;

Route::get('/', function () {
    //return view('welcome');
    return "Inicio de WebZas";
});

route::resource('boardgames', BoardgamesController::class);
