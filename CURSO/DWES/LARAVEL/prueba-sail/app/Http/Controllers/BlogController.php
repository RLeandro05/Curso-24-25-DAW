<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return "Hola, desde el Blog";
    }


    public function show($nombre) {
        return view('blog', ['nombre' => $nombre]);
        }
}
