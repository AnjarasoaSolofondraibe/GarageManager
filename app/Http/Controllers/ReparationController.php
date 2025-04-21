<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Reparation;
use App\Models\Employe;
use App\Models\User;
use Illuminate\Http\Request;

class ReparationController extends Controller
{
    public function vehiculeReparations(Vehicule $vehicule)
    {
        $reparations = $vehicule->reparations; // si la relation est bien définie
        return view('reparations.vehicule', compact('vehicule', 'reparations'));
    }

    public function index() {
        $vehicules = Vehicule::with('reparations.mecaniciens')->get();

        return view('reparations.index', compact('vehicules'));
    }

    public function en_cours()
    {
        $vehicule = Vehicule::with('reparations')->get();
        $reparations = Reparation::where('status','en_cours')->get();
        return view('reparations.index', compact('reparations', 'vehicule'));
    }

    public function create()
    {
        $vehicules = Vehicule::with('client')->orderBy('immatriculation')->get();
        $mecaniciens = Employe::where('poste', 'Mécanicien')->get();
        return view('reparations.create', compact('vehicules', 'mecaniciens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'description' => 'required|string',
            'cout' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $reparation = Reparation::create($request->all());
        $reparation->mecaniciens()->sync($request->mecaniciens);

        return redirect()->route('reparations.index')->with('success', 'Réparation enregistrée.');
    }

    public function edit($id)
    {
        $reparation = Reparation::with('mecaniciens')->findOrFail($id);
        $vehicules = Vehicule::all(); // si tu veux permettre de changer le véhicule
        $mecaniciens = Employe::all();

        return view('reparations.edit', compact('reparation', 'vehicules', 'mecaniciens'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string',
            'date' => 'required|date',
            'etat' => 'nullable|string',
            'vehicule_id' => 'required|exists:vehicules,id',
            'mecaniciens' => 'nullable|array',
            'mecaniciens.*' => 'exists:mecaniciens,id',
        ]);

        $reparation = Reparation::findOrFail($id);
        $reparation->update($request->only(['description', 'date', 'etat', 'vehicule_id']));
        $reparation->mecaniciens()->sync($request->mecaniciens ?? []);

        return redirect()->route('vehicules.reparations.index', $reparation->vehicule_id)
                        ->with('success', 'Réparation mise à jour.');
    }


    public function show()
    {
        $vehicules = Vehicule::whereHas('reparations', function ($query) {
            $query->where('etat', 'en cours');
        })->with(['reparations' => function ($query) {
            $query->where('etat', 'en cours');
        }])->get();

        return view('reparations.en_cours', compact('vehicules'));
    }

    
}
