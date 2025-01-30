<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BlogController extends Controller
{
    // Muestra todos los artículos
    public function index()
    {
        return "Mostrando todos los artículos del blog.";
    }

    // Muestra un artículo específico
    public function show($id)
    {
        return "Mostrando el artículo con ID: {$id}.";
    }

    // Muestra el formulario para crear un artículo
    public function create()
    {
        return "Formulario para crear un nuevo artículo.";
    }
}
