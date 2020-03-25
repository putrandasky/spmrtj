<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('apps.survey');
});
Route::get('/map', function () {
    return view('apps.gmap');
});
Route::get('respondent/survey/auth-respondent', 'Respondent\AuthController@checkExist');
Route::get('respondent/survey/preference/park-car', 'Respondent\PreferenceController@getParkCar');
Route::post('respondent/survey/preference/park-car', 'Respondent\PreferenceController@storeParkCar');
Route::get('respondent/survey/preference/park-motor', 'Respondent\PreferenceController@getParkMotor');
Route::post('respondent/survey/preference/park-motor', 'Respondent\PreferenceController@storeParkMotor');
Route::get('respondent/survey/preference/pedestrian', 'Respondent\PreferenceController@getPedestrian');
Route::post('respondent/survey/preference/pedestrian', 'Respondent\PreferenceController@storePedestrian');
Route::get('respondent/survey/preference/cycle', 'Respondent\PreferenceController@getCycle');
Route::post('respondent/survey/preference/cycle', 'Respondent\PreferenceController@storeCycle');
Route::get('respondent/survey/preference/feeder', 'Respondent\PreferenceController@getFeeder');
Route::post('respondent/survey/preference/feeder', 'Respondent\PreferenceController@storeFeeder');
Route::get('respondent/survey/preference/feeder-park', 'Respondent\PreferenceController@getFeederPark');
Route::post('respondent/survey/preference/feeder-park', 'Respondent\PreferenceController@storeFeederPark');
Route::get('respondent/survey/preference/feeder-premium', 'Respondent\PreferenceController@getFeederPremium');
Route::post('respondent/survey/preference/feeder-premium', 'Respondent\PreferenceController@storeFeederPremium');
Route::post('respondent/survey/preference/park-ride-common', 'Respondent\PreferenceController@storeParkRideCommon');
Route::get('respondent/survey/preference/park-ride-car', 'Respondent\PreferenceController@getParkRideCar');
Route::post('respondent/survey/preference/park-ride-car', 'Respondent\PreferenceController@storeParkRideCar');
Route::get('respondent/survey/preference/park-ride-motor', 'Respondent\PreferenceController@getParkRideMotor');
Route::post('respondent/survey/preference/park-ride-motor', 'Respondent\PreferenceController@storeParkRideMotor');
Route::post('respondent/survey/preference/park-ride-hypo-motor', 'Respondent\PreferenceController@storeParkRideHypoMotor');
Route::post('respondent/survey/preference/park-ride-hypo-car', 'Respondent\PreferenceController@storeParkRideHypoCar');
Route::get('respondent/survey/social-data', 'Respondent\SurveyController@getSocialData');
Route::post('respondent/survey/social-data', 'Respondent\SurveyController@storeSocialData');
Route::post('respondent/survey/travel-data', 'Respondent\SurveyController@storeTravelData');
Route::get('respondent/survey/travel-data', 'Respondent\SurveyController@getTravelData');
Route::get('respondent/survey/additional-data', 'Respondent\SurveyController@getAdditionalData');
Route::post('respondent/survey/additional-data', 'Respondent\SurveyController@storeAdditionalData');
Route::post('respondent/survey/personal-data', 'Respondent\SurveyController@storePersonalData');
Route::get('respondent/survey/personal-data', 'Respondent\SurveyController@getPersonalData');
Route::get('geocoding', 'Google\GoogleController@geocoding');
Route::get('area', 'Google\GoogleController@area');
Route::get('line', 'Google\MapController@waypoint');
Route::get('station', 'Google\MapController@station');
Route::get('map-data', 'Google\MapController@mapData');

Route::post('route', 'Google\MapController@routePathWithFeeder');


