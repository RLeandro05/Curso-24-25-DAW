<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolaController extends Controller
{
    public function index()
    {
        return "Hola, desde el controlador";
    }

    public function show($nombre) {
        return view('hola', ['nombre' => $nombre]);
        }
        
}

?>

