<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travail extends Model
{
    use HasFactory;

    protected $fillable = ['reparation_id', 'titre', 'description', 'statut'];

    public function reparation() {

        return $this->belongsTo(Reparation::class);

    }

    public function employes() {

        return $this->belongsToMany(Employe::class, 'employe_travail');

    }
}
