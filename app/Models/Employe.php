<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'prenom', 'email', 'adresse', 'telephone', 'poste','date_embauche', 'salaire','status'];

    public function reparations()
    {
        return $this->belongsToMany(Reparation::class, 'employe_reparation', 'employe_id', 'reparation_id');
    }

    public function specialites() 
    {
        
        return $this->BelongsToMany(Specialite::class);
        
    }

    public function travaux() {
        
        return $this->hasMany(Travail::class);

    }
}
