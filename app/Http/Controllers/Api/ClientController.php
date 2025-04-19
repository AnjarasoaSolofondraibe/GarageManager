<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('vehicules')->paginate(10);
        
        return response()->json($clients);
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

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès.');
    }

    //  Affiche un client (optionnel)
    public function show(Client $client)
    {
        return response()->json($client);
    }

    //  Met à jour les infos
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client mis à jour.');
    }

    // Supprime un client
    public function destroy(Client $client)
    {
        if ($client->vehicules()->count() > 0) {
            return redirect()->route('clients.index')->with('error', 'Impossible de supprimer ce client. Il possède encore des véhicules.');
        }
    
        $client->delete();
    
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }


    public function vehicules(Client $client)
    {
        // charge les véhicules du client
        $vehicules = $client->vehicules()->latest()->get();

        return view('clients.vehicules', compact('client', 'vehicules'));
    }
}
