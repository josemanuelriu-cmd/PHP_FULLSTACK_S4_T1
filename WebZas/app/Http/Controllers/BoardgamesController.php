<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardGameRequest;
use Illuminate\Http\Request;
use App\Models\boardgames;
use App\Models\types;

class BoardgamesController extends Controller
{
    public function index(Request $request)
    {
        /*
        $boardgames = Boardgames::orderBy('name', 'asc')->paginate(9);
        return view('boardgames.index', ['boardgames' => $boardgames]);
        */
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
        $boardgame->load('types'); // carga los tipos del juego
        $types = Types::orderBy('type')->get(); // todos los tipos disponibles
        return view('boardgames.show', [
            'boardgame' => $boardgame,
            'types' => $types
            ]);
    }
    public function create()
    {
        $types = Types::orderBy('type')->get(); // todos los tipos disponibles
        return view('boardgames.create', [
            'types' => $types
            ]);
    }    
    public function edit(Boardgames $boardgame)
    {
        $boardgame->load('types'); // carga los tipos del juego
        $types = Types::orderBy('type')->get(); // todos los tipos disponibles
        return view('boardgames.edit', [
            'boardgame' => $boardgame,
            'types' => $types
            ]);
    }
    public function store(StoreBoardGameRequest $request)
    {
        //$boardgame=Boardgames::create($request->validate());
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
            'name' => 'required|string|min:5|max:255', //['required', 'string', 'min:5', 'max:255'] //se pueden usar ambas formas
            'slug' => 'required|string|min:5|max:255|unique:boardgames,slug,' . $boardgame->id, //unique:tabla,columna,excepto_id
            'min_players' => 'required|integer|min:1',
            'max_players' => 'required|integer|min:1|gte:min_players',
            'min_age' => 'required|integer|min:6',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);

        $boardgame->update($request->all());
        $boardgame->types()->sync($request->types ?? []);
        //return redirect()->route('boardgames.show', $boardgame);
        return redirect()->route('boardgames.show', $boardgame)->with('success', __('messages.Boardgame updated'));
    }
}
