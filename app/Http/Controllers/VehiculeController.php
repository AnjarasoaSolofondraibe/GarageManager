<?php

namespace App\Http\Controllers;


use App\Models\Vehicule;
use App\Models\Client;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::all();
        $query = Vehicule::with('client');

        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $vehicules = $query->paginate(10);

        return view('vehicules.index', compact('vehicules', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = \App\Models\Client::orderBy('nom')->get();
        return view('vehicules.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'immatriculation' => 'required|string|max:255|unique:vehicules',
            'annee' => 'nullable|integer',
            'couleur' => 'nullable|string|max:50',
        ]);
    
        \App\Models\Vehicule::create($request->all());
    
        return redirect()->route('clients.index')->with('success', 'Véhicule ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Vehicule $vehicule)
    {
        $clients = Client::all();
        return view('vehicules.edit', compact('vehicule', 'clients'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'marque' => 'required',
            'modele' => 'required',
            'immatriculation' => 'required|unique:vehicules,immatriculation,' . $vehicule->id,
            'annee' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        $vehicule->update($request->all());

        return redirect()->route('vehicules.index')->with('success', 'Véhicule modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reparations(Vehicule $vehicule)
    {
        $reparations = $vehicule->reparations()->latest()->get();
        return view('vehicules.reparations', compact('vehicule', 'reparations'));
    }
}
