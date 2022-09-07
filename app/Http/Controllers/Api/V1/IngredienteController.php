<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\IngredienteResource;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IngredienteResource::collection(Ingrediente::with('alergenos')->get());
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

        $ingrediente = Ingrediente::create($request->all());

        $ingrediente->alergenos()->attach($request->alergenos);

        $ingrediente->load('alergenos');

        return IngredienteResource::make($ingrediente)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function show(Ingrediente $ingrediente)
    {
        return new IngredienteResource($ingrediente->load('alergenos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingrediente $ingrediente)
    {
        //TODO: Validar datos, comprobar que no existe mismo nombre, etc...

        $ingrediente->update($request->all());

        $ingrediente->alergenos()->sync($request->alergenos);

        $ingrediente->load('alergenos');

        return IngredienteResource::make($ingrediente)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingrediente  $ingrediente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingrediente $ingrediente)
    {
        $ingrediente->delete();

        return response()->json(null, 204);
    }
}
