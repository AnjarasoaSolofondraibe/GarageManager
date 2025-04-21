<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employe;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employe::all();
        
        return response()->json($employees, 200);
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
            'email' => 'required|email|unique:employees',
            'date_embauche' => 'required|date', 
        ]);

        Employe::create($request->all());

        return response()->json(['message' => 'Employé ajouté avec succès'], 201);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employe = Employe::where('id',$id)->findOrFail();
        
        return response()->json($employe, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employe = Employe::where('id',$id)->findOrFail();

        if(!$employe) {
            return response()->json(['message','Employé non trouvé', 404]);
        }

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:employees',
            'date_embauche' => 'required|date', 
        ]);

        $employe->update($request->all());

        return response()->json(['message' => 'Employé modifié avec succès'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employe = Employe::where('id', $id)->findOrFail();

        if(!$employe) {
            return response()->json(['message' => 'Employé supprimé avec succès'], 200);
        }

        $employe->delete();

        return response()->json(['success','Employé supprimé'], 200);
    }
}
