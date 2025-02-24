<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Titulos extends Model
{
    /** @use HasFactory<\Database\Factories\TitulosFactory> */
    use HasFactory;

    protected $fillable = ['tenista_id', 'torneo_id', 'anno'];

    public function tenista()
    {
        return $this->belongsTo(Tenista::class);
    }
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }

}
