<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicule;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::all();

        return response()->json($vehicules, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:vehicules',
            'annee' => 'digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'couleur' => 'nullable|string|max:50',
        ]);

        $vehicule = Vehicule::create($data);

        return response()->json($vehicule, 201);
    }

    public function show($id)
    {
        $vehicule = Vehicule::findOrFail($id);

        if(!$vehicule) {
            return response()->json(['message' => 'Vehicule non trouvé'], 404);
        }

        return response()->json($vehicule, 200);
    }

    public function update(Request $request, $id)
    {
        $vehicule = Vehicule::findOrFail($id);

        if(!$vehicule) {
            return response()->json(['message' => 'Vehicule non trouvé'], 404);
        }

        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:vehicules',
            'annee' => 'digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'couleur' => 'nullable|string|max:50',
        ]);

        $vehicule->update($data);

        return response()->json($vehicule, 200);
    }

    public function destroy($id)
    {
        $vehicule = Vehicule::findOrFail($id);

        if(!$vehicule) {
            return response()->json(['message' => 'Vehicule non trouvé'], 404);
        }

        $vehicule->delete();

        return response()->json(['message' => 'Véhicule supprimé'], 200);
    }
}
