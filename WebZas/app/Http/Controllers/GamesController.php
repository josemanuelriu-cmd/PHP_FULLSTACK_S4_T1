<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use Illuminate\Http\Request;
use App\Models\zassessions;
use App\Models\boardgames;
use App\Models\user;
use App\Models\games;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function create(zassessions $zassession)
    {
        //$user = auth()->user();
        $user = Auth::user();

        // usuarios apuntados a la sesión
        $users = $zassession->users;

        // juegos disponibles
        $boardgames = boardgames::where(function ($query) use ($user) {

            $query->where('owner_user_id',null)
                ->orWhere('owner_user_id',$user->id);

        })->orderBy('name')->get();

        return view('games.create',[
            'zassession' => $zassession,
            'users' => $users,
            'boardgames' => $boardgames
        ]);
    }
    public function store(StoreGameRequest $request, Zassessions $zassession)
    {

        $boardgame = Boardgames::findOrFail($request->boardgame_id);

        // crear partida
        $game = Games::create([
            'zassession_id' => $zassession->id,
            'boardgame_id' => $boardgame->id,
            'host_user_id' => Auth::id(),
            'max_players' => $boardgame->max_players,
            'start_time' => $request->start_time,
            'status' => $request->status,
            'necesary_know_how' => $request->boolean('necesary_know_how')
        ]);

        // añadir jugadores
        $game->players()->attach($request->players);

        return redirect()
            ->route('zassessions.show',$zassession)
            ->with('success','Partida creada correctamente');
    }
}
