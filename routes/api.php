<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ApiController;


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

Route::resource('apartments', 'ApiController');
Route::get('apartments/search/{name}', 'ApiController@search');
Route::get('apartments/search/rooms/{rooms}', 'ApiController@searchRooms');
Route::get('apartments/search/baths/{baths}', 'ApiController@searchBaths');
Route::get('apartments/search/beds/{beds}', 'ApiController@searchBeds');

Route::get('apartments/services', 'ApiController@getServices');


// Route::get('apartments/search/{lat}{long}{radius}', 'ApiController@multiSearch');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('apartments/frontend', 'SearchController@frontend');
Route::get('apartments/backend', 'SearchController@backend');

// Route::get('/apartments/all', 'ApiController@index');
// Route::post('/apartments/store', 'ApiController@store');
