<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use Illuminate\Http\Request;
use App\Models\Zassessions;
use App\Models\Boardgames;
use App\Models\Boardgames as ModelsBoardgames;
use App\Models\Games;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function create(zassessions $zassession)
    {
        $user = Auth::user();

        $users = $zassession->users;

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

        $game = Games::create([
            'zassession_id' => $zassession->id,
            'boardgame_id' => $boardgame->id,
            'host_user_id' => Auth::id(),
            'max_players' => $boardgame->max_players,
            'start_time' => $request->start_time,
            'status' => $request->status,
            'necesary_know_how' => $request->boolean('necesary_know_how')
        ]);

        $game->players()->attach($request->players);

        return redirect()
            ->route('zassessions.show',$zassession)
            ->with('success',__('messages.game created successfully'));
    }
    public function show(zassessions $zassession, Games $game)
    {
        $game->load(['boardgame','players','host']);
        $user = Auth::user();

        $isUserJoined = false;

        if ($user) {
            $isUserJoined = $zassession->users()->where('users.id', $user->id)->exists();
            }

        return view('games.show', [
            'zassession' => $zassession,
            'game' => $game,
            'isUserJoined' => $isUserJoined
            ]);
    }

    public function join(Zassessions $zassession, Games $game)
    {
        $user = Auth::user();
        $game->load('players');

        if (!$game->players()->where('user_id', $user->id)->exists()) {
            $game->players()->attach($user->id);
        }

        return redirect()->route('games.show', [$zassession, $game])
            ->with('success', __('messages.You have signed up for the game'));
    }
    public function leave(Zassessions $zassession, Games $game)
    {
        $game->players()->detach(Auth::id());

        return redirect()
            ->route('games.show', [$zassession, $game])
            ->with('success', __('messages.You have deleted yourself from the game'));
    }

    public function destroy(Zassessions $zassession, Games $game)
    {
        $game->delete();

        return redirect()
            ->route('zassessions.show', ['zassessions' => $zassession])
            ->with('success',__('messages.Game deleted'));
    }
    public function close(Zassessions $zassession, Games $game)
    {
        $game->update([
            'status' => 'playing'
        ]);

        return redirect()
            ->route('games.show', [$zassession, $game])
            ->with('success', __('messages.game closed'));
    }
    public function reopen(Zassessions $zassession, Games $game)
    {
        $game->update([
            'status' => 'open'
        ]);

        return redirect()
            ->route('games.show', [$zassession, $game])
            ->with('success', __('messages.Game reopened'));
    }

    public function update(Request $request, Zassessions $zassession, Games $game)
    {
        $request->validate([
            'start_time' => 'required|string', 
            'status' => 'required|string',
            'necesary_know_how' => 'nullable|boolean'
        ]);

        $game->update($request->all());
        $game->players()->sync($request->players ?? []);

        return redirect()
            ->route('games.show', [$zassession, $game])
            ->with('success', __('messages.Updated game'));
    }
    public function edit(Zassessions $zassession, Games $game)
    {        
        $game->load(['players','boardgame']);
        
        $boardgames = Boardgames::orderBy('name')->get();
        $users = $zassession->users;
        
        return view('games.edit',[
            'zassession' => $zassession,
            'game' => $game,
            'boardgames' => $boardgames,
            'users' => $users
        ]);
    }
}
