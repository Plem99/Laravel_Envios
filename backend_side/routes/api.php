<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Controlador de 'Envio'
use \App\Http\Controllers\EnvioController;
//Controlador de 'Rastreo'
use \App\Http\Controllers\RastreoController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Creamos un registro de envio
Route::post('/envio', [EnvioController::class, 'validarEnvio']);

//Obtener el estado del envio
Route::post('/rastreo', [RastreoController::class, 'rastrearEnvio']);
