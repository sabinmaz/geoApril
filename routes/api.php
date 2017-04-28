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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'GEO\Http\Controllers\Api'], function ($api) {
        $api->get('countries', ['as' => 'countries', 'uses' => 'AddressController@getCountries']);
        $api->get('countries-min', ['as' => 'countries.min', 'uses' => 'AddressController@getAllCountriesMinData']);

        $api->get('{country}/provinces', ['as' => 'country.provinces', 'uses' => 'AddressController@getProvinceByCountry']);
        $api->get('{country}/{province}', ['as' => 'country.province', 'uses' => 'AddressController@getCommuneByProvince']);
        $api->get('{country}/{province}/{commune}', ['as' => 'country.commune', 'uses' => 'AddressController@getZonesByCommune']);
        $api->get('{country}/{province}/{commune}/{zone}', ['as' => 'country.colline', 'uses' => 'AddressController@getCollinesByZone']);
        $api->get('{country}/{province}/{commune}/{zone}/{colline}', ['as' => 'country.locality', 'uses' => 'AddressController@getLocalitiesByColline']);
    });
});