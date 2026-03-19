<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardgameRequest;
use Illuminate\Http\Request;
use App\Models\Boardgames;
use App\Models\Types;

class BoardgamesController extends Controller
{
    public function index(Request $request)
    {
        $boardgames = Boardgames::with('types')
        ->ofType($request->type)
        ->searchName($request->name)
        ->players($request->players)
        ->age($request->age)
        ->duration($request->duration)
        ->paginate(9);

        $types = Types::orderBy('type')->get();

        return view('boardgames.index', compact('boardgames','types'));
    }
    public function show(boardgames $boardgame)
    {
        $boardgame->load('types');
        $types = Types::orderBy('type')->get();
        return view('boardgames.show', [
            'boardgame' => $boardgame,
            'types' => $types
            ]);
    }
    public function create()
    {
        $types = Types::orderBy('type')->get(); 
        return view('boardgames.create', [
            'types' => $types
            ]);
    }    
    public function edit(Boardgames $boardgame)
    {
        $boardgame->load('types'); 
        $types = Types::orderBy('type')->get(); 
        return view('boardgames.edit', [
            'boardgame' => $boardgame,
            'types' => $types
            ]);
    }
    public function store(StoreBoardGameRequest $request)
    {
        $boardgame=Boardgames::create($request->validated());
        $boardgame->types()->sync($request->types ?? []);
        
        return redirect()->route('boardgames.show', $boardgame)->with('success', __('messages.Boardgame created'));
    }
    public function destroy(Boardgames $boardgame)
    {
        $boardgame->delete();
        return redirect()->route('boardgames.index')->with('success',  __('messages.Boardgame eliminated'));
    }
    public function update(Request $request, Boardgames $boardgame)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255', 
            'slug' => 'required|string|min:5|max:255|unique:boardgames,slug,' . $boardgame->id, 
            'min_players' => 'required|integer|min:1',
            'max_players' => 'required|integer|min:1|gte:min_players',
            'min_age' => 'required|integer|min:6',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $boardgame->update($request->all());
        $boardgame->types()->sync($request->types ?? []);
        return redirect()->route('boardgames.show', $boardgame)->with('success', __('messages.Boardgame updated'));
    }
}
