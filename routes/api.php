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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('respondent/survey/travel-data', 'Respondent\SurveyController@storeTravelData');
Route::post('respondent/survey/area-coverage', 'Respondent\SurveyController@areaCoverage');

Route::post('route', 'Google\MapController@routePathWithFeeder');
