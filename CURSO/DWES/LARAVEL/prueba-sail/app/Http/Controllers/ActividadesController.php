<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActividadesController extends Controller
{
    public function actividadesVistas()
    {
        
        $usuarios = ['Javier', 'Clara', 'Paco', 'Leandro', 'Marta'];

        
        $nivel = [1-3]; 

        
        $categorias = ['Admin', 'Editor', 'Suscriptor'];

        
        return view('actividades', compact('usuarios', 'nivel', 'categorias'));
    }
}
