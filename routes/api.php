<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('idioma', 'Idioma\IdiomaController');
Route::resource('entidad', 'Entidad\EntidadController');
Route::resource('tipoAviso', 'TipoAviso\TipoAvisoController');
Route::resource('zona', 'Zona\ZonaController');
Route::resource('ubicacion', 'Ubicacion\UbicacionController');
Route::resource('tipoColor', 'TipoColor\TipoColorController', ['except' => ['create', 'edit']]);
Route::resource('tipoLuz', 'TipoLuz\TipoLuzController', ['except' => ['create', 'edit']]);
Route::resource('tipoCaracter', 'TipoCaracter\TipoCaracterController', ['except' => ['create', 'edit']]);