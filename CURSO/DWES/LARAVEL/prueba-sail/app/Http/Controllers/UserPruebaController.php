<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPruebaController extends Controller
{
    public function quienesSomos() {
        $usuarios = ['María', 'Juan', 'Pedro'];
        return view('quienesSomos', ['usuarios' => $usuarios]);
    }
}
