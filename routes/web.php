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
Route::get('respondent/survey/preference/park-car', 'Respondent\PreferenceController@getParkCar');
Route::get('respondent/survey/preference/park-motor', 'Respondent\PreferenceController@getParkMotor');
Route::get('respondent/survey/preference/pedestrian', 'Respondent\PreferenceController@getPedestrian');
Route::get('respondent/survey/preference/cycle', 'Respondent\PreferenceController@getCycle');
Route::get('respondent/survey/preference/feeder', 'Respondent\PreferenceController@getFeeder');
Route::get('respondent/survey/preference/feeder-premium', 'Respondent\PreferenceController@getFeederPremium');
Route::get('respondent/survey/preference/park-ride-car', 'Respondent\PreferenceController@getParkRideCar');
Route::get('respondent/survey/preference/park-ride-motor', 'Respondent\PreferenceController@getParkRideMotor');
Route::get('respondent/survey/social-data', 'Respondent\SurveyController@getSocialData');
Route::get('respondent/survey/travel-data', 'Respondent\SurveyController@getTravelData');
Route::get('respondent/survey/additional-data', 'Respondent\SurveyController@getAdditionalData');
Route::get('geocoding', 'Google\GoogleController@geocoding');
Route::get('area', 'Google\GoogleController@area');
