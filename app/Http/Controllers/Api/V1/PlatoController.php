<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PlatoResource;
use App\Models\Plato;
use Illuminate\Http\Request;

class PlatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PlatoResource::collection(Plato::with('ingredientes')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TODO: Validar datos, comprobar que no existe mismo nombre, etc...

        $plato = Plato::create($request->all());

        $plato->ingredientes()->attach($request->ingredientes);

        $plato->load('ingredientes');

        return PlatoResource::make($plato)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function show(Plato $plato)
    {
        return new PlatoResource($plato->load('ingredientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plato $plato)
    {
        //TODO: Validar datos, comprobar que no existe mismo nombre, etc...

        $plato->update($request->all());

        $plato->ingredientes()->sync($request->ingredientes);

        $plato->load('ingredientes');

        return PlatoResource::make($plato)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plato  $plato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plato $plato)
    {
        $plato->delete();

        return response()->json(null, 204);
    }
}
