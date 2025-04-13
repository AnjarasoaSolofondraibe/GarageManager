<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;

class SpecialiteController extends Controller
{
    public function index()
    {
        $specialites = Specialite::paginate(10);
        return view('specialites.index', compact('specialites'));
    }

    public function create()
    {
        return view('specialites.create');
    }

    public function store(Request $request)
    {
        Specialite::create($request->only(['nom']));
        return redirect()->route('specialites.index')->with('success', 'Spécialité créée.');
    }

    public function edit(Specialite $specialite)
    {
        return view('specialites.edit', compact('specialite'));
    }

    public function update(Request $request, Specialite $specialite)
    {
        $specialite->update($request->only(['nom']));
        return redirect()->route('specialites.index')->with('success', 'Spécialité mise à jour.');
    }

    public function destroy(Specialite $specialite)
    {
        $specialite->delete();
        return redirect()->route('specialites.index')->with('success', 'Spécialité supprimée.');
    }
    
}
