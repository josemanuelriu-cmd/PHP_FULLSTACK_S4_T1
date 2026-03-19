<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZassessionsRequest;
use App\Http\Requests\UpdateZassessionsRequest;
use App\Models\Boardgames;
use Illuminate\Http\Request;
use App\Models\Zassessions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ZassessionsController extends Controller
{
    public function index(Request $request)
    {         
        $query = Zassessions::orderBy('date', 'asc');

        if (!$request->has('show_past')) {
            $query->whereDate('date', '>=', today());
        }   
        $zassessions = $query->paginate(6);
        $users = User::orderBy('nickname')->get();
        return view('Zassessions.index', [
            'zassessions' => $zassessions, 
            'users' => $users,
            'showPast' => $request->has('show_past')
        ]);
    }
    public function show(Zassessions $Zassession)
    {
        $Zassession->load([
            'users',
            'games.boardgame',
            'games.players',
            'games.host'
            ]);
        $users = User::orderBy('nickname')->get(); 
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
            ->with('success', __('messages.You have signed up for the session'));
    }
    public function leave(Zassessions $zassession)
    {
        $zassession->users()->detach(Auth::id());

        return redirect()
            ->route('zassessions.show', $zassession)
            ->with('success', __('messages.You have deleted yourself from the session'));
    }

    public function createGame(Zassessions $zassession)
    {
        $user = Auth::user();

        $users = $zassession->users;

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

         return redirect()
            ->route('zassessions.show', $zassession)
            ->with('success', __('messages.Created game'));
    }
}
