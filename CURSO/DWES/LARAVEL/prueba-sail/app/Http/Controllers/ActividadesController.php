<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function actividadesVistas() {
        $usuarios = ["Leandro", "Javier", "Manolo"];
        $nivel = [1, 2, 3];
        $categorias = ["Admin", "Editor", "Suscriptor"];

        return view("actividadesVistas", compact('usuarios', 'nivel', 'categorias'));
    }
}
