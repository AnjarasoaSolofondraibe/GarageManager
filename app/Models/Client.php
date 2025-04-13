<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'telephone', 'email', 'adresse'];

    public function vehicules()
    {
        return $this->hasMany(\App\Models\Vehicule::class);
    }

}
