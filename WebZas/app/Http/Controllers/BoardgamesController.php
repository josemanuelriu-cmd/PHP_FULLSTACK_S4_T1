<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoardGameRequest;
use Illuminate\Http\Request;
use App\Models\boardgames;

class BoardGamesController extends Controller
{
    public function index()
    {
        //$boardgames = boardgames::orderBy('name', 'asc')->get();
        $boardgames = boardgames::orderBy('name', 'asc')->paginate(5);
        return view('BoardGames.BoardGames', ['boardgames' => $boardgames]);
    }
    public function show(boardgames $boardgame)
    {
        //$boardgame = boardgames::find($gameid);
        return view('BoardGames.Show', ['boardgame' => $boardgame]);
    }
    public function create()
    {
        return view('BoardGames.Add');
    }    
    public function edit(boardgames $boardgame)
    {
        //$boardgame = boardgames::find($id);
        return view('BoardGames.Edit', ['boardgame' => $boardgame]);
    }

    public function store(StoreBoardGameRequest $request)
    {
        //en laravel validation estan todas las disponibles  https://laravel.com/docs/10.x/validation#available-validation-rules
        //lo pasamos a StoreBoardGameRequest y cambiamos el tipo de dato recibido de Request a StoreBoardGameRequest que hemos creado e importado
        /*$request->validate([
            'name' => 'required|string|min:5|max:255', //['required', 'string', 'min:5', 'max:255'] //se pueden usar ambas formas
            'slug' => 'required|string|min:5|max:255|unique:boardgames,slug',
            'min_players' => 'required|integer|min:1',
            'max_players' => 'required|integer|min:1|gte:min_players',
            'min_age' => 'required|integer|min:6',
            'duration' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ]);
        */
        //mejora 2
        boardgames::create($request->all());        
        /*
        //mejora 1
        boardgames::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'min_players' => $request->input('min_players'),
            'max_players' => $request->input('max_players'),
            'min_age' => $request->input('min_age'),
            'duration' => $request->input('duration'),
            'description' => $request->input('description')
        ]);
        */        
        /*
        //forma tradicional
        $boardgames = new boardgames();
        $boardgames->name = $request->input('name');
        $boardgames->slug = $request->input('slug');
        $boardgames->min_players = $request->input('min_players');
        $boardgames->max_players = $request->input('max_players');
        $boardgames->min_age = $request->input('min_age');
        $boardgames->duration = $request->input('duration');
        $boardgames->description = $request->input('description');
        $boardgames->save();
        */  
        return redirect()->route('boardgames.index');
    }
    public function destroy(boardgames $boardgame)
    {
        //$boardgame = boardgames::find($id);
        $boardgame->delete();
        //return redirect('/boardgames');
        return redirect()->route('boardgames.index');
    }
    public function update(Request $request, boardgames $boardgame)
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
        //mejora 2
        $boardgame->update($request->all());
            
        /*
        //forma tradicional
        //$boardgame = boardgames::find($id);
        $boardgame->name = $request->input('name');
        $boardgame->slug = $request->input('slug');
        $boardgame->min_players = $request->input('min_players');
        $boardgame->max_players = $request->input('max_players');
        $boardgame->min_age = $request->input('min_age');
        $boardgame->duration = $request->input('duration');
        $boardgame->description = $request->input('description');
        $boardgame->save();
        */
        return redirect()->route('boardgames.show', $boardgame);
    }
}
