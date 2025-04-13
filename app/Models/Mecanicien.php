<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mecanicien extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'email', 'telephone']; // ajoute ici les autres champs si nécessaire


    public function reparations()
    {
        return $this->belongsToMany(Reparation::class);
    }

    public function specialites()
    {
        return $this->belongsToMany(Specialite::class);
    }
}
