<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenista extends Model
{
    /** @use HasFactory<\Database\Factories\TenistaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'apellidos', 'altura', 'anno_nacimiento', 'mano'];

    public function titulos() {
        return $this->hasMany(Titulo::class);
    }

}
