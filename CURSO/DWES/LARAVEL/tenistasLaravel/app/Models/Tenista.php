<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenista extends Model
{
    /** @use HasFactory<\Database\Factories\TenistaFactory> */
    use HasFactory;

    protected $fillable = ['nombre', 'ciudad', 'superficie'];

    public function titulos() {
        return $this->hasMany(Titulo::class);
    }

}
