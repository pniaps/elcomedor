<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    /**
     * Relación con los ingredientes que tiene el plato
     */
    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class)->withTimestamps();;
    }
}
