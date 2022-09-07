<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AlergenoResource;
use App\Models\Alergeno;
use Illuminate\Http\Request;

class AlergenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AlergenoResource::collection(Alergeno::all());
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

        $alergeno = Alergeno::create($request->all());

        return AlergenoResource::make($alergeno)->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alergeno  $alergeno
     * @return \Illuminate\Http\Response
     */
    public function show(Alergeno $alergeno)
    {
        return new AlergenoResource($alergeno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alergeno  $alergeno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alergeno $alergeno)
    {
        //TODO: Validar datos, comprobar que no existe mismo nombre, etc...

        $alergeno->update($request->all());

        return AlergenoResource::make($alergeno)->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alergeno  $alergeno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alergeno $alergeno)
    {
        $alergeno->delete();

        return response()->json(null, 204);
    }
}
