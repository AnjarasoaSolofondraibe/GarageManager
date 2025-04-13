<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'marque', 'modele', 'immatriculation', 'annee', 'couleur', 'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function reparations()
    {
        return $this->hasMany(\App\Models\Reparation::class);
    }

}
