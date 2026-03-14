<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZassessionsRequest;
use App\Http\Requests\UpdateZassessionsRequest;
use App\Models\Boardgames;
use Illuminate\Http\Request;
use App\Models\zassessions;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class ZassessionsController extends Controller
{
    public function index()
    {            
        $Zassessions = Zassessions::orderBy('date', 'asc')->paginate(6);
        $Users = User::orderBy('nickname')->get();
        return view('Zassessions.index', ['zassessions' => $Zassessions, 'users' => $Users]);
    }
    public function show(Zassessions $Zassession)
    {
        $Zassession->load([
            'users',
            'games.boardgame',
            'games.players',
            'games.host'
            ]);
        $users = User::orderBy('nickname')->get(); // todos los usuarios disponibles
        return view('Zassessions.show', [
            'zassession' => $Zassession,
            'users' => $users
            ]);
    }
    public function create()
    {
        return view('Zassessions.create');
    }    
    public function edit(Zassessions $Zassession)
    {
        return view('Zassessions.edit', ['zassession' => $Zassession]);
    } 
    public function store(StoreZassessionsRequest $request)
    {        
        $request->merge([
            'latitude' => str_replace(',', '.', $request->latitude),
            'longitude' => str_replace(',', '.', $request->longitude),
        ]);
        Zassessions::create($request->all());
        return redirect()->route('zassessions.index');
    }
    public function destroy(Zassessions $Zassession)
    {
        $Zassession->delete();
        return redirect()->route('zassessions.index');
    }
    public function update(UpdateZassessionsRequest $request, Zassessions $Zassession)
    {
        /*
        $request->validate([
            'date' => 'required|date|after_or_equal:today|unique:Zassessions,date,' . $Zassession->date,
            'name' => 'required|string|min:3|max:255|unique:Zassessions,name,' . $Zassession->name,
            'event_name' => 'nullable|string|min:3|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_users' => 'required|integer|min:1',
            'direction' => 'required|string|min:5|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);
        */

        $Zassession->update($request->all());
        return redirect()->route('zassessions.show', $Zassession);
    }
    
    public function join(Zassessions $zassession)
    {
        $user = Auth::user();

        if (!$zassession->users()->where('user_id', $user->id)->exists()) {
            $zassession->users()->attach($user->id);
        }

        return redirect()->route('zassessions.show', $zassession)
            ->with('success', 'Te has apuntado a la sesión');
    }
    public function leave(Zassessions $zassession)
    {
        $zassession->users()->detach(Auth::id());

        return redirect()
            ->route('zassessions.show', $zassession)
            ->with('success', 'Te has borrado de la sesión');
    }

    public function createGame(Zassessions $zassession)
    {
        //$user = auth()->user();
        $user = Auth::user();

        // Usuarios que pueden jugar (los apuntados a la sesión)
        $users = $zassession->users;

        // Juegos disponibles
        $boardgames = \App\Models\Boardgames::where(function ($query) use ($user) {
            $query->where('owner_user_id',  $user->id)
                ->orWhere('owner_user_id', null);
        })->orderBy('name')->get();

        return view('zassessions.games.create', [
            'zassession' => $zassession,
            'users' => $users,
            'boardgames' => $boardgames
        ]);
            
    }

    public function storeGame(Request $request, Zassessions $zassession)
    {
        $request->validate([
            'boardgame_id' => 'required|exists:boardgames,id',
            'players' => 'required|array|min:1'
        ]);

        // aquí guardarías la partida

        return redirect()
            ->route('zassessions.show', $zassession)
            ->with('success', 'Partida creada');
    }
}
