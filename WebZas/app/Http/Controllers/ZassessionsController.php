<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZassessionsRequest;
use App\Http\Requests\UpdateZassessionsRequest;
use Illuminate\Http\Request;
use App\Models\Zassessions;

class ZassessionsController extends Controller
{
    public function index()
    {        
        $Zassessions = Zassessions::orderBy('date', 'asc')->paginate(6);
        return view('Zassessions.index', ['zassessions' => $Zassessions]);
    }
    public function show(Zassessions $Zassession)
    {
        return view('Zassessions.show', ['zassession' => $Zassession]);
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
        return redirect()->route('Zassessions.index');
    }
    public function destroy(Zassessions $Zassession)
    {
        $Zassession->delete();
        return redirect()->route('Zassessions.index');
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
        return redirect()->route('Zassessions.show', $Zassession);
    }
}
