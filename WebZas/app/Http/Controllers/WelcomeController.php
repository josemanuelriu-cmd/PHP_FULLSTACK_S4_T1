<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zassessions;

class WelcomeController extends Controller
{
    public function index()
    {
        $nextSession = Zassessions::with([
            'users',
            'games.boardgame',
            'games.players',
            'games.host'
        ])
        ->whereDate('date','>=',today())
        ->orderBy('date')
        ->orderBy('start_time')
        ->first();

        return view('welcome', [
            'zassession' => $nextSession
        ]);
    }
}