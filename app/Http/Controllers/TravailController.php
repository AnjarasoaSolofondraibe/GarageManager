<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travail;
use App\Models\Employe;
use App\Models\Reparation;

class TravailController extends Controller
{

    public function create($reparationId) {
        
        $reparation = Reparation::findOrFail($reparationId);
        $employes = Employe::all();

        return view('travaux.create', compact('reparation', 'employes'));
    }

    public function storeTravail(Request $request, $reparationId) {

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'employes' => 'required|array',
            'employes.*' => 'exists:employes,id',
        ]);
    
        $travail = Travail::create([
            'reparation_id' => $reparationId,
            'titre' => $request->titre,
            'description' => $request->description,
            'statut' => 'en_attente',
        ]);
    
        $travail->employes()->attach($request->employes);
    
        return redirect()->route('reparations.show', $reparationId)
            ->with('success', 'Travail attribué avec succès.');
    }
}
