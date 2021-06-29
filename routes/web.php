<?php

use Illuminate\Support\Facades\Route;
use App\Apartment;
use App\Service;
use Illuminate\Support\Facades\DB;


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



Auth::routes();

// Route::get('/', 'HomeController@index')->name('index');
Route::get('/', 'ApartmentController@index')->name('apartments.index');
Route::get('apartments/{slug}', 'ApartmentController@show')->name('apartments.show');
Route::get('services/{id}', 'ServiceController@index')->name('service.index');




Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')
  ->group(function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('apartments', 'ApartmentController');
    Route::resource('services', 'ServiceController');
    Route::resource('messages', 'MessageController');
  });
