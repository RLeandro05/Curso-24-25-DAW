<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HolaController extends Controller
{
    public function index() {
        return "Hola, mundo";
    }
    public function show($nombre) {
        //return "Hola, $nombre";
        return view('saludo', ['nombre' => $nombre]);
    }
}
