<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('vehicules')->get();
        
        return response()->json($clients, 200);
    }

    //  Enregistre un nouveau client
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
        ]);

        Client::create($request->all());

        return response()->json(['message' => 'Client enregistré avec succès.'], 201);
    }

    //  Affiche un client (optionnel)
    public function show($id)
    {
        $client = Client::with('vehicules')->findOrFail($id);
        
        if(!$client) {
            return response()->json(['message' => 'Client non trouvé'], 404);
        }

        return response()->json($client, 200);
    }

    //  Met à jour les infos
    public function update(Request $request, $id)
    {
        $client = Client::with('vehicules')->findOrFail($id);

        if(!$client) {
            return response()->json(['message' => 'Client non trouvé'], 404);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
        ]);

        $client->update($request->all());

        return response()->json($client, 200);
    }

    // Supprime un client
    public function destroy($id)
    {
        $client = Client::with('vehicules')->findOrFail($id);

        if ($client->vehicules()->count() > 0) {
            return response()->json(['error'=>'Impossible de supprimer ce client. Il possède encore des véhicules.'],500);
        }
    
        $client->delete();
    
        return response()->json(['message' => 'Client supprimé avec succès.'], 200);
    }


    public function vehicules(Client $client)
    {
        // charge les véhicules du client
        $vehicules = $client->vehicules()->latest()->get();

        //return view('clients.vehicules', compact('client', 'vehicules'));
        return response()->json($vehicules, 200);
    }
}
