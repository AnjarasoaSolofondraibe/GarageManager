<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use App\Models\Reparation;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class ReparationController extends Controller
{
    public function vehiculeReparations(Vehicule $vehicule)
    {
        $reparations = $vehicule->reparations; // si la relation est bien définie

        return response()->json($reparations);
    }

    public function index()
    {
        $vehicule = Vehicule::with('reparations')->all();
        
        return response()->json($vehicule, 200);
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

        return response()->json(['success', 'Réparation enregistrée.'],201);
    }

    public function showWithEmploye($id)
    {
        $reparation = Reparation::with('employée')->whereHas('employee', function($query) {
            $query->whereIn('poste',['mecanicien','electricien','peintre','tolier']);
        })->get();

        return response()->json($reparation, 200);
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


    public function showVehicules()
    {
        $vehicules = Vehicule::whereHas('reparations', function ($query) {
            $query->where('etat', 'en cours');
        })->with(['reparations' => function ($query) {
            $query->where('etat', 'en cours');
        }])->get();

        return response()->json($vehicules);
    }

    
}
