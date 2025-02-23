<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    /** @use HasFactory<\Database\Factories\TorneoFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'ciudad'];
    public function titulos()
    {
        return $this->hasMany(Titulo::class);
    }

}
