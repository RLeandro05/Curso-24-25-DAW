<?php

namespace App\Http\Controllers;

use App\Models\Tenista;
use Illuminate\Http\Request;

class TenistasController extends Controller
{
    // Mostrar listado de tenistas
    public function index() {
        $tenistas = Tenista::orderBy(column:"id")->paginate(perPage:5);
        return view("index.indexTenistas", [
            "tenistas" => $tenistas,
        ]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('create.createTenistas');
    }

    // Guardar nuevo tenista
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'altura' => 'required|numeric',
            'anno_nacimiento' => 'required|integer|min:1900|max:' . date('Y'),
            'mano' => 'required|string|in:Diestro,Zurdo',
        ]);

        Tenista::create($request->all());

        return redirect()->route('index.indexTenistas')->with('success', 'Tenista añadido con éxito.');
    }

    // Mostrar formulario de edición
    public function edit(Tenista $tenista)
    {
        return view('edit.editTenistas', compact('tenista'));
    }

    // Actualizar tenista
    public function update(Request $request, Tenista $tenista)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'altura' => 'required|numeric',
            'anno_nacimiento' => 'required|integer|min:1900|max:' . date('Y'),
            'mano' => 'required|string|in:Diestro,Zurdo',
        ]);

        $tenista->update($request->all());

        return redirect()->route('index.indexTenistas')->with('success', 'Tenista actualizado correctamente.');
    }

    // Eliminar tenista
    public function destroy(Tenista $tenista)
    {
        $tenista->delete();
        return redirect()->route('index.indexTenistas')->with('success', 'Tenista eliminado correctamente.');
    }
}
