<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenista extends Model
{
   
       
    /** @use HasFactory<\Database\Factories\TenistaFactory> */
    use HasFactory;

    protected $fillable=[
        'nombre',
        'apellidos',
        'altura',
        'mano',
        'anno_nacimiento'
    ];

    public function titulos() {
        return $this->hasMany(Titulos::class);
    }

}
