<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    /** @use HasFactory<\Database\Factories\TituloFactory> */
    use HasFactory;

    protected $fillable = ['tenista_id', 'torneo_id', 'anio'];
    public function tenista()
    {
        return $this->belongsTo(Tenista::class);
    }
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }
}
