<?php

namespace App\Http\Controllers;

use App\Models\Mecanicien;
use App\Models\Specialite;
use Illuminate\Http\Request;

class MecanicienController extends Controller
{
    //$mecanicien = Mecanicien::create($request->all());
    //$mecanicien->specialites()->sync($request->specialites);

    public function index()
    {
        $mecaniciens = Mecanicien::with('specialites')->paginate(10);
        return view('mecaniciens.index', compact('mecaniciens'));
    }

    public function create()
    {
        $specialites = Specialite::all();
        return view('mecaniciens.create', compact('specialites'));
    }

    public function store(Request $request)
    {
        $mecanicien = Mecanicien::create($request->only(['nom', 'email', 'telephone']));
        $mecanicien->specialites()->sync($request->specialites);
        return redirect()->route('mecaniciens.index')->with('success', 'Mécanicien créé.');
    }

    public function edit(Mecanicien $mecanicien)
    {
        $specialites = Specialite::all();
        return view('mecaniciens.edit', compact('mecanicien', 'specialites'));
    }

    public function update(Request $request, Mecanicien $mecanicien)
    {
        $mecanicien->update($request->only(['nom', 'email', 'telephone']));
        $mecanicien->specialites()->sync($request->specialites);
        return redirect()->route('mecaniciens.index')->with('success', 'Mécanicien mis à jour.');
    }

    public function destroy(Mecanicien $mecanicien)
    {
        $mecanicien->delete();
        return redirect()->route('mecaniciens.index')->with('success', 'Mécanicien supprimé.');
    }
}
