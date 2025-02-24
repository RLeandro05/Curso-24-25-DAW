<?php

namespace App\Http\Controllers;

use App\Http\Requests\TitulosRequest;
use App\Models\Tenista;
use App\Models\Titulos;
use App\Models\Torneo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TitulosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulos = Titulos::with(['tenista', 'torneo'])
            ->selectRaw('ROW_NUMBER() OVER(ORDER BY anno DESC) as id, anno, tenista_id, torneo_id, created_at')
            ->paginate(5);

        return view('titulos.index', compact('titulos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('titulos.create', [
            'titulo' => new Titulos(),
            'tenistas' => Tenista::all(),
            'torneos' => Torneo::all(),
            'actionUrl' => route('titulos.store'),
            'method' => 'POST',
            'submitButtonText' => 'Añadir título',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TitulosRequest $request): RedirectResponse
    {
        Titulos::create($request->validated()); // Validamos y guardamos el título
        return redirect()->route('titulos.index')->with('success', 'Título añadido correctamente.');
    }

    /**
     * Display the specified resource.
     */

    public function show(Titulos $titulo)
    {
        return view('titulos.show', compact('titulo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($anno, $tenista_id, $torneo_id)
    {
        $titulo = Titulos::where('anno', $anno)
            ->where('tenista_id', $tenista_id)
            ->where('torneo_id', $torneo_id)
            ->firstOrFail();

        return view('titulos.edit', [
            'titulo' => $titulo,
            'tenistas' => Tenista::all(),
            'torneos' => Torneo::all(),
            'actionUrl' => route('titulos.update', [
                'anno' => $titulo->anno,
                'tenista_id' => $titulo->tenista_id,
                'torneo_id' => $titulo->torneo_id
            ]),
            'method' => 'PUT',
            'submitButtonText' => 'Actualizar título',
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $anno, $tenista_id, $torneo_id)
    {
        // Encuentra el título con la clave primaria compuesta
        $titulo = Titulos::where('anno', $anno)
            ->where('tenista_id', $tenista_id)
            ->where('torneo_id', $torneo_id);

        // Verifica si el título existe antes de intentar actualizar
        if ($titulo->exists()) {
            $titulo->update($request->except(['_token', '_method']));
            return redirect()->route('titulos.index')->with('success', 'Título actualizado correctamente.');
        } else {
            return redirect()->route('titulos.index')->with('error', 'No se encontró el título.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($anno, $tenista_id, $torneo_id)
    {
        $deleted = Titulos::where([
            'anno' => $anno,
            'tenista_id' => $tenista_id,
            'torneo_id' => $torneo_id,
        ])->delete();

        if ($deleted) {
            return redirect()->route('titulos.index')->with('success', 'Título eliminado correctamente.');
        }

        return redirect()->route('titulos.index')->with('error', 'No se encontró el título.');
    }

}
