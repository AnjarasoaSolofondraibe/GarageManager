<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    use HasFactory;

    protected $fillable = ['vehicule_id', 'description', 'cout', 'date'];

    public function vehicule()
    {
        return $this->belongsTo(\App\Models\Vehicule::class);
    }

    public function mecaniciens()
    {
        return $this->belongsToMany(Employe::class, 'employe_reparation');
    }
}
