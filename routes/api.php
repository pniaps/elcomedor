<?php

use App\Http\Controllers\Api\V1\AlergenoController;
use App\Http\Controllers\Api\V1\IngredienteController;
use App\Http\Controllers\Api\V1\PlatoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('v1/alergenos', AlergenoController::class);
Route::apiResource('v1/ingredientes', IngredienteController::class);
Route::apiResource('v1/platos', PlatoController::class);
