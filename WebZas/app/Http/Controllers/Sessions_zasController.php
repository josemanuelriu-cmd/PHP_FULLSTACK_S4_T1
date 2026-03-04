<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessions_zasRequest;
use App\Http\Requests\UpdateSessions_zasRequest;
use Illuminate\Http\Request;
use App\Models\Sessions_zas;

class Sessions_zasController extends Controller
{
    public function index()
    {        
        $sessions_zas = Sessions_zas::orderBy('date', 'asc')->paginate(6);
        return view('sessions_zas.index', ['sessions_zas' => $sessions_zas]);
    }
    public function show(Sessions_zas $session_zas)
    {
        return view('sessions_zas.show', ['session_zas' => $session_zas]);
    }
    public function create()
    {
        return view('sessions_zas.create');
    }    
    public function edit(Sessions_zas $session_zas)
    {
        return view('sessions_zas.edit', ['session_zas' => $session_zas]);
    } 
    public function store(StoreSessions_zasRequest $request)
    {        
        $request->merge([
            'latitude' => str_replace(',', '.', $request->latitude),
            'longitude' => str_replace(',', '.', $request->longitude),
        ]);
        Sessions_zas::create($request->all());
        return redirect()->route('sessions_zas.index');
    }
    public function destroy(Sessions_zas $session_zas)
    {
        $session_zas->delete();
        return redirect()->route('sessions_zas.index');
    }
    public function update(UpdateSessions_zasRequest $request, Sessions_zas $session_zas)
    {
        /*
        $request->validate([
            'date' => 'required|date|after_or_equal:today|unique:sessions_zas,date,' . $session_zas->date,
            'name' => 'required|string|min:3|max:255|unique:sessions_zas,name,' . $session_zas->name,
            'event_name' => 'nullable|string|min:3|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_users' => 'required|integer|min:1',
            'direction' => 'required|string|min:5|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);
        */

        $session_zas->update($request->all());
        return redirect()->route('sessions_zas.show', $session_zas);
    }
}
