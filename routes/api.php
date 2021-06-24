<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/', 'ApartmentController@indexdb');
// Route::get('/apartments/{slug}', 'ApartmentController@showdb');
// Route::get('https://api.tomtom.com/search/2/structuredGeocode.json?countryCode=IT&streetName={indirizzo}&municipality={citta}&key={key}', function()
// {
//   return  response()->json([
//     'data' => 'response',
//     'success' => true,
//   ]);
// });
