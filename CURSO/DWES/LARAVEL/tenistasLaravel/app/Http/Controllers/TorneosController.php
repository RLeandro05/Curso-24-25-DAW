<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class TorneosController extends Controller
{
    // Mostrar listado de torneos
    public function index() {
        $torneos = Torneo::orderBy(column:"id")->paginate(perPage:5);
        return view("index.indexTorneos", [
            "torneos" => $torneos,
        ]);
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('create.createTorneos');
    }

    // Guardar nuevo torneo
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255'
        ]);

        Torneo::create($request->all());

        return redirect()->route('index.indexTorneos')->with('success', 'Torneo añadido con éxito.');
    }

    // Mostrar formulario de edición
    public function edit(Torneo $torneo)
    {
        return view('edit.editTorneos', compact('torneo'));
    }

    // Actualizar torneo
    public function update(Request $request, Torneo $torneo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255'
        ]);

        $torneo->update($request->all());

        return redirect()->route('index.indexTorneos')->with('success', 'Torneo actualizado correctamente.');
    }

    // Eliminar torneo
    public function destroy(Torneo $torneo)
    {
        $torneo->delete();
        return redirect()->route('index.indexTorneos')->with('success', 'Torneo eliminado correctamente.');
    }
}
