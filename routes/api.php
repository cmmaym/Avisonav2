<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('language', 'Language\LanguageController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);
Route::resource('language.aviso', 'Language\LanguageAvisoController')->only([
    'index'
]);
Route::resource('language.aviso.ayuda', 'Language\LanguageAvisoAyudaController')->only([
    'index'
]);

Route::resource('entity', 'Entity\EntityController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('tipoAviso', 'TipoAviso\TipoAvisoController');

Route::resource('zona', 'Zona\ZonaController');

Route::resource('ubicacion', 'Ubicacion\UbicacionController');

Route::resource('tipoColor', 'TipoColor\TipoColorController');

Route::resource('tipoLuz', 'TipoLuz\TipoLuzController');

Route::resource('tipoCaracter', 'TipoCaracter\TipoCaracterController');

Route::resource('aviso', 'Aviso\AvisoController');
Route::resource('aviso.carta', 'Aviso\AvisoCartaController');

Route::resource('ayuda', 'Ayuda\AyudaController');
