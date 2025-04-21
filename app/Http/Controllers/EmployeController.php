<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Specialite;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = Employe::with('specialites')->paginate(10);
        
        return view('employes.index', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employes.create');
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
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'nullable|email|unique:employes',
            'date_embauche' => 'required|date', 
        ]);

        Employe::create($request->all());
        return redirect()->route('employes.index')->with('success', 'Employé ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employe = Employe::with('specialites')->findOrFail($id);
        $specialites = Specialite::all(); // 🔹 à ajouter

        return view('employes.edit', compact('employe', 'specialites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employe $employe)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'date_embauche' => 'required|date', 
        ]);

        $employe->update($request->all());
        $employe->specialites()->sync($request->specialites);
        return redirect()->route('employes.index')->with('success', 'Employé modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('employes.index')->with('success','Employé supprimé');
    }
}
