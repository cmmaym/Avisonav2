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

//Language
Route::resource('language', 'Language\LanguageController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('language.notice', 'Language\LanguageNoticeController')->only([
    'show'
]);

// Route::resource('language.aviso.ayuda', 'Language\LanguageAvisoAyudaController')->only([
//     'index'
// ]);


//Entity
Route::resource('entity', 'Entity\EntityController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//NoveltyType
Route::resource('noveltyType', 'NoveltyType\NoveltyTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('noveltyType.noveltyTypeLang', 'NoveltyType\NoveltyTypeLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//Zone
Route::resource('zone', 'Zone\ZoneController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('zone.zoneLang', 'Zone\ZoneLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//Location
Route::resource('location', 'Location\LocationController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//ColorType
Route::resource('colorType', 'ColorType\ColorTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('colorType.child', 'ColorType\ColorTypeChildController')->only([
    'index', 'store'
]);


//LightType
Route::resource('lightType', 'lightType\lightTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('lightType.lightTypeLang', 'lightType\lightTypeLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//CharacterType
Route::resource('characterType', 'CharacterType\CharacterTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('characterType.child', 'CharacterType\CharacterTypeChildController')->only([
    'index', 'store'
]);


//Chart
Route::resource('chart', 'Chart\ChartController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('chart.chartEdition', 'Chart\ChartEditionController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//Notice
Route::resource('notice', 'Notice\NoticeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('notice.noticeDetail', 'Notice\NoticeDetailController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('notice.aid', 'Notice\NoticeAidController')->only([
    'index', 'update', 'destroy'
]);


//Aid
Route::resource('aid', 'Aid\AidController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('aid.aidDetail', 'Aid\AidDetailController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);


//Coordinate
Route::resource('coordinate', 'Coordinate\CoordinateController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);


// Route::resource('aviso.carta', 'Aviso\AvisoCartaController');

