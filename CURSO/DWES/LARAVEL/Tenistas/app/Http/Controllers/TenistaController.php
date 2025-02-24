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
        Tenista::create($request->validated());//Validamos
        return redirect()->route('tenistas.index');
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
    public function destroy(TenistaRequest $request, Tenista $tenista): RedirectResponse
    {
        $tenista->delete();
        return redirect()->route('tenistas.index');

    }
}
