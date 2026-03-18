<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeRequest;
use Illuminate\Http\Request;
use App\Models\types;
use Nette\Utils\Type;

class TypesController extends Controller
{
    public function index()
    {        
        $types = Types::orderBy('type', 'asc')->paginate(12);
        return view('types.index', ['types' => $types]);
    }
    public function show(Types $type)
    {
        return view('types.show', ['type' => $type]);
    }
    public function create()
    {
        return view('types.create');
    }    
    public function edit(Types $type)
    {
        return view('types.edit', ['type' => $type]);
    } 
    public function store(StoreTypeRequest $request)
    {        
        Types::create($request->all());
        return redirect()->route('types.index');
    }
    public function destroy(Types $type)
    {
        $type->delete();
        return redirect()->route('types.index');
    }
    public function update(Request $request, Types $type)
    {
        $request->validate([
            'type' => 'required|string|min:3|max:255|unique:types,type,' . $type->id,
            'description' => 'nullable|string'
        ]);

        $type->update($request->all());
        $type->boardgames()->sync($request->boardgames ?? []);
        return redirect()->route('types.show', $type)->with('success', __('messages.Updated type'));
    }
}
