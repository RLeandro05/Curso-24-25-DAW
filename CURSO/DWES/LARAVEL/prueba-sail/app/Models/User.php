<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // Asegúrate de agregar este campo
    ];
    protected $casts = [
        'is_admin' => 'boolean', // Para que Laravel lo maneje como booleano
    ];
    // Método de acceso para verificar si el usuario es administrador
    public function isAdmin(): bool {
        return $this->is_admin;
    }
}
