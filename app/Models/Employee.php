<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'adresse', 'telephone', 'poste','date_embauche', 'salaire','status'];

    public function reparations()
    {
        return $this->belongsToMany(Reparation::class, 'employee_reparation', 'employee_id', 'reparation_id');
    }
}
