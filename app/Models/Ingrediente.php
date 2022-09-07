<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    /**
     * Relación con los alérgenos que tiene el ingrediente
     */
    public function alergenos()
    {
        return $this->belongsToMany(Alergeno::class)->withTimestamps();;
    }
}
