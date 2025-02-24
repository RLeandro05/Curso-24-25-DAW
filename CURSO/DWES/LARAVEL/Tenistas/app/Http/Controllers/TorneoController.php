<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    // Atributo privado para almacenar las superficies
    private array $superficies = [
        1 => 'Césped',
        2 => 'Arcilla',
        3 => 'Cemento'
    ];

    /**
     * Muestra la lista de torneos.
     */
    public function index()
    {
        // Obtener torneos paginados y transformar la superficie_id en nombre
        $torneos = Torneo::orderBy('id')->paginate(5)->through(function ($torneo) {
            $torneo->superficie_nombre = $this->superficies[$torneo->superficie_id] ?? 'Desconocida';
            return $torneo;
        });

        return view('torneos.index', [
            'torneos' => $torneos
        ]);
    }

    /**
     * Muestra el formulario para crear un nuevo torneo.
     */
    public function create()
    {
        return view('torneos.create', [
            'torneo' => new Torneo(),
            'superficies' => $this->superficies,
            'actionUrl' => route('torneos.store'),
            'method' => 'POST',
            'submitButtonText' => 'Crear torneo'
        ]);
    }

    /**
     * Guarda un nuevo torneo en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'superficie_id' => 'required|integer|in:' . implode(',', array_keys($this->superficies))
        ]);

        Torneo::create($validated);

        return redirect()->route('torneos.index')->with('success', 'Torneo creado correctamente.');
    }

    /**
     * Muestra un torneo específico.
     */
    public function show(Torneo $torneo)
    {
        $torneo->superficie_nombre = $this->superficies[$torneo->superficie_id] ?? 'Desconocida';

        return view('torneos.show', [
            'torneo' => $torneo
        ]);
    }

    /**
     * Muestra el formulario para editar un torneo.
     */
    public function edit(Torneo $torneo)
    {
        return view('torneos.edit', [
            'torneo' => $torneo,
            'superficies' => $this->superficies,
            'actionUrl' => route('torneos.update', $torneo),
            'method' => 'PUT',
            'submitButtonText' => 'Actualizar torneo'
        ]);
    }

    /**
     * Actualiza un torneo en la base de datos.
     */
    public function update(Request $request, Torneo $torneo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'superficie_id' => 'required|integer|in:' . implode(',', array_keys($this->superficies))
        ]);

        $torneo->update($validated);

        return redirect()->route('torneos.index')->with('success', 'Torneo actualizado correctamente.');
    }

    /**
     * Elimina un torneo, validando si tiene títulos asociados.
     */
    public function destroy(Torneo $torneo)
    {
        if ($torneo->titulos()->count() > 0) {
            return redirect()->route('torneos.index')
                ->with('error', 'No se puede eliminar el torneo porque tiene títulos asociados.');
        }

        $torneo->delete();
        return redirect()->route('torneos.index')->with('success', 'Torneo eliminado correctamente.');
    }
}
