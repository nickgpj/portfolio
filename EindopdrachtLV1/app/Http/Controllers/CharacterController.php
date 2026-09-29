<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Character;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::all();
        return view('index', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'game' => 'required|max:100',
            'released' => 'required|date',
        ]);

        Character::create($validatedData);
        return redirect()->route('index')->with('success', 'Character added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $character = Character::findOrFail($id);
        return view('show', ['character' => $character]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $character = Character::findOrFail($id);
        return view('edit', ['character' => $character]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:100',
            'game' => 'required|max:100',
            'released' => 'required|date'
        ]);

        Character::findOrFail($id)->update($validateData);

        return redirect()->route('characters.show', $id)->with('success', 'Character updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Character::destroy($id);
        return redirect()->route('index')->with('success', 'Character deleted successfully');
    }
}
