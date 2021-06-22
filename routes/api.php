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

// Route::get('/apartments', 'ApartmentController@database');
// Route::get('/apartments/{id}',function ($id)
// {
//   $appartamento = DB::table('apartments')
//                  ->where('id', '=', $id)
//                  ->get();
//                  console.log($id);
// });
