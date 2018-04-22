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

Route::resource('noveltyType', 'NoveltyType\NoveltyTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('noveltyType.child', 'NoveltyType\NoveltyTypeChildController')->only([
    'index', 'store'
]);

Route::resource('zone', 'Zone\ZoneController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('zone.child', 'Zone\ZoneChildController')->only([
    'index', 'store'
]);

Route::resource('location', 'Location\LocationController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('colorType', 'ColorType\ColorTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('colorType.child', 'ColorType\ColorTypeChildController')->only([
    'index', 'store'
]);

Route::resource('lightType', 'lightType\lightTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('lightType.child', 'lightType\lightTypeChildController')->only([
    'index', 'store'
]);

Route::resource('characterType', 'CharacterType\CharacterTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('characterType.child', 'CharacterType\CharacterTypeChildController')->only([
    'index', 'store'
]);

Route::resource('chart', 'Chart\ChartController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

// Route::resource('chartEdition', 'ChartEdition\ChartEditionController')->only([
//     'index', 'show', 'store', 'update', 'destroy'
// ]);

Route::resource('notice', 'Notice\NoticeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('notice.noticeDetail', 'Notice\NoticeDetailController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('notice.aid', 'Notice\NoticeAidController')->only([
    'index', 'update', 'destroy'
]);

Route::resource('aid', 'Aid\AidController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('aid.aidDetail', 'Aid\AidDetailController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);


// Route::resource('aviso.carta', 'Aviso\AvisoCartaController');

