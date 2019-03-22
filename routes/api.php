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

Route::post('/login', 'LoginController@authenticate');
Route::post('/login/refresh', 'LoginController@refresh');
Route::post('/logout', 'LoginController@logout')->middleware('auth:api');


Route::get('user/me', 'UserController@me')->middleware('auth:api');
Route::resource('user', 'UserController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

//Role
Route::resource('role', 'RoleController')->only([
    'index'
]);

//Language
Route::resource('language', 'Language\LanguageController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('language.notice', 'Language\LanguageNoticeController')->only([
    'show'
]);

//NoveltyType
Route::resource('noveltyType', 'NoveltyType\NoveltyTypeController')->only([
    'index', 'show', 'store', 'destroy'
]);

Route::resource('noveltyType.noveltyTypeLang', 'NoveltyType\NoveltyTypeLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//Zone
Route::resource('zone', 'Zone\ZoneController')->only([
    'index', 'show', 'store', 'destroy'
]);

Route::resource('zone.zoneLang', 'Zone\ZoneLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//Location
Route::resource('location', 'Location\LocationController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//ColorLight
Route::resource('colorLight', 'ColorLight\ColorLightController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('colorLight.colorLightLang', 'ColorLight\ColorLightLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

//ColorStructure
Route::resource('colorStructure', 'ColorStructure\ColorStructureController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('colorStructure.colorStructureLang', 'ColorStructure\ColorStructureLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//LightClass
Route::resource('lightClass', 'LightClass\LightClassController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('lightClass.lightClassLang', 'LightClass\LightClassLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//CharacterType
Route::resource('characterType', 'CharacterType\CharacterTypeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('characterType.characterTypeLang', 'CharacterType\CharacterTypeLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);


//Chart
Route::resource('chart', 'Chart\ChartController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('chart.chartEdition', 'Chart\ChartEditionController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('chartEdition', 'Chart\EditionChartController')->only([
    'index'
]);

Route::get('chart/getSpatialData/{id}', 'Chart\ChartController@getSpatialData');
Route::put('chart/updateSpatialData/{id}', 'Chart\ChartController@updateSpatialData');


//Notice
Route::resource('notice', 'Notice\NoticeController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('notice.noticeLang', 'Notice\NoticeLangController')->only([
    'index', 'show', 'store', 'update', 'destroy'
]);

Route::resource('notice.aid', 'Notice\NoticeAidController')->only([
    'index', 'update', 'destroy'
]);

Route::resource('notice.novelty', 'Notice\NoticeNoveltyController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::get('getTotalNoticeNovelty', 'Notice\NoticeController@getTotalNoticeNovelty');

//Notice Public route
Route::get('getNotice/{id}', 'Notice\NoticeController@getNotice');
Route::get('getAllNoticeYear', 'Notice\NoticeController@getAllNoticeYear');
Route::get('getAllNoticeNumberByYear/{year}', 'Notice\NoticeController@getAllNoticeNumberByYear');
Route::get('getRecentNotice', 'Notice\NoticeController@getRecentNotice');

Route::resource('consecutive', 'Consecutive\ConsecutiveController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

//Aid
Route::resource('aid', 'Aid\AidController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('aid.aidLang', 'Aid\AidLangController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('aid.coordinate', 'Aid\AidCoordinateController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);
    
Route::resource('aid.chart', 'Aid\AidChartController')->only([
    'index', 'update', 'destroy'
]);

Route::resource('aid.colorStructure', 'Aid\AidColorStructureController')->only([
    'index', 'update', 'destroy'
]);

Route::resource('aid.colorLight', 'Aid\AidColorsLightController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::resource('aid.height', 'Aid\AidHeightController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::resource('aid.nominalScope', 'Aid\AidNominalScopeController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::resource('aid.period', 'Aid\AidPeriodController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::resource('aid.period.sequenceFlashes', 'Aid\AidPeriodSequenceFlashesController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::get('export/aid', 'Aid\AidController@export');

Route::get('aid/getPosition/{id}', 'Aid\AidController@getPosition');
Route::put('aid/updatePosition/{id}', 'Aid\AidController@updatePosition');

//AidTypeForm
Route::resource('aidTypeForm', 'Aid\AidTypeFormController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('aidTypeForm.aidTypeFormLang', 'Aid\AidTypeFormLangController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

//AidType
Route::resource('aidType', 'Aid\AidTypeController')->only([
    'index', 'store', 'show', 'destroy'
]);

Route::resource('aidType.aidTypeLang', 'Aid\AidTypeLangController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

//Danger
Route::resource('danger', 'Danger\DangerController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('danger.dangerLang', 'Danger\DangerLangController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::resource('danger.chart', 'Danger\DangerChartController')->only([
    'index', 'update', 'destroy'
]);

Route::get('danger/getPosition/{id}', 'Danger\DangerController@getPosition');
Route::put('danger/updatePosition/{id}', 'Danger\DangerController@updatePosition');

//TopMark
Route::resource('topMark', 'TopMark\TopMarkController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

Route::get('topMarkImage/{id}', 'TopMark\TopMarkImageController@show');
Route::resource('topMark.topMarkImage', 'TopMark\TopMarkImageController')->only([
    'store'
]);

Route::resource('topMark.topMarkLang', 'TopMark\TopMarkLangController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);


//Catalog Ocean Coast
Route::resource('catalogOceanCoast', 'CatalogOceanCoast\CatalogOceanCoastController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

//Light List
Route::resource('lightList', 'LightList\LightListController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

//Report Source
Route::resource('reportSource', 'ReportSource\ReportSourceController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

//Reporting User
Route::resource('reportingUser', 'ReportingUser\ReportingUserController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

//Image
Route::resource('image', 'Image\ImageController')->only([
    'index', 'store', 'show', 'destroy'
]);
Route::get('/image/getImage/{id}', 'Image\ImageController@getImage');
Route::post('/image/update/{id}', 'Image\ImageController@update');

//Symbol
Route::resource('symbol', 'Symbol\SymbolController')->only([
    'index', 'store', 'show', 'update', 'destroy'
]);

//Novelty
Route::get('getAllNovelty', 'Notice\NoveltyController@getAllNovelty');
Route::get('novelty/getCurrentNoveltys', 'Notice\NoveltyController@getCurrentNoveltys');
Route::get('novelty/getNovelty/{id}', 'Notice\NoveltyController@getNovelty');
Route::resource('novelty', 'Notice\NoveltyController')->only([
    'index'
]);

Route::resource('novelty.noveltyLang', 'Notice\NoveltyLangController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::resource('novelty.chartEdition', 'Notice\NoveltyChartEditionController')->only([
    'index', 'update', 'destroy'
]);

Route::resource('novelty.noveltyFile', 'Notice\NoveltyFileController')->only([
    'index', 'store', 'update', 'destroy'
]);

Route::get('novelty/getSpatialData/{id}', 'Notice\NoveltyController@getSpatialData');
Route::put('novelty/updateSpatialData/{id}', 'Notice\NoveltyController@updateSpatialData');

//Reports
Route::get('report/noticeNoveltyGTP', 'Notice\ReportController@noticeNoveltyGTP');