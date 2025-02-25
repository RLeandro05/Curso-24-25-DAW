<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenistaRequest;
use App\Models\Tenista;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TenistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Para que nos pagine lo que se traiga de tenistas
        //$tenistas = Tenista::latest('id')->paginate(perPage: 5);
        $tenistas = Tenista::withCount('titulos')
            ->orderBy('titulos_count', 'desc')
            ->paginate(5);

        return view('tenistas.index', [
            'tenistas' => $tenistas,
        ]);
    }

    public function TitulosTenista(Tenista $tenista)
    {
        // Obtener los títulos del tenista, junto con la información del torneo
        $titulos = $tenista->titulos()->with('torneo')->paginate(5);

        return view('tenistas.titulos', [
            'tenista' => $tenista,
            'titulos' => $titulos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenistas.create', [
            'tenista' => new Tenista(),
            'actionUrl' => route('tenistas.store'),
            'method' => 'POST',
            'sumbitButtonText' => 'Añadir tenista',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TenistaRequest $request): RedirectResponse
    {
        $tenista = Tenista::create($request->validated()); //Validamos

        if ($tenista) {
            return redirect()->route('tenistas.index')
                ->with('success', 'Seha añadido correctamente el tenista.');
        }

        return redirect()->route('tenistas.index')
            ->with('error', 'No se puede añadir el tenista.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenista $tenista)
    {
        return view('tenistas.edit', [
            'tenista' => $tenista,
            'method' => 'PUT',
            'actionUrl' => route('tenistas.update', $tenista),
            'sumbitButtonText' => 'Actualizar tenista',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TenistaRequest $request, Tenista $tenista): RedirectResponse
    {
        $tenista->update($request->validated());
        return redirect()->route('tenistas.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenista $tenista): RedirectResponse
{
    //Verificar si el tenista tiene títulos relacionados
    if ($tenista->titulos()->exists()) {
        return redirect()->route('tenistas.index')
            ->with('error', 'No se puede eliminar el tenista porque tiene títulos relacionados.');
    }

    //Si no tiene títulos, proceder con la eliminación
    $tenista->delete();
    return redirect()->route('tenistas.index')
        ->with('success', 'Tenista eliminado correctamente.');
}
}
