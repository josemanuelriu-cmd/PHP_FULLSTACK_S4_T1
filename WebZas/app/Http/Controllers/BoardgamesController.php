<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardGameRequest;
use Illuminate\Http\Request;
use App\Models\boardgames;

class BoardgamesController extends Controller
{
    public function index()
    {
        $boardgames = Boardgames::orderBy('name', 'asc')->paginate(9);
        return view('boardgames.index', ['boardgames' => $boardgames]);
    }
    public function show(boardgames $boardgame)
    {
        return $boardgame;
        return view('boardgames.show', ['boardgame' => $boardgame]);
    }
    public function create()
    {
        return view('boardgames.create');
    }    
    public function edit(Boardgames $boardgame)
    {
        return view('boardgames.edit', ['boardgame' => $boardgame]);
    }
    public function store(StoreBoardGameRequest $request)
    {
        Boardgames::create($request->all());        
        return redirect()->route('boardgames.index');
    }
    public function destroy(Boardgames $boardgame)
    {
        $boardgame->delete();
        return redirect()->route('boardgames.index');
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
        return redirect()->route('boardgames.show', $boardgame);
    }
}
