<?php

use Illuminate\Support\Facades\Route;
use App\Apartment;
use App\Service;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\Apartment as ApartmentResource;


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

Route::get('/', 'ApartmentController@index')->name('apartments.index');
Route::get('apartments/{slug}', 'ApartmentController@show')->name('apartments.show');

Route::get('services/{apartment}', 'ServiceController@index')->name('service.index');

// Route::resource('apartments', 'ApartmentController');

Route::get('/search/{input}', 'SearchController@filter')->name('search.advanced');
Route::get('/search/', 'SearchController@querySearch')->name('search.advanced');

Route::post('store', 'MessageController@store')->name("messages.store");

Route::post('/views/{apartment}', 'ViewController@store')->name('views.store');

Route::middleware('auth')
->namespace('Admin')
->prefix('admin')
->name('admin.')
->group(function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('apartments', 'ApartmentController');
    Route::resource('services', 'ServiceController');
    Route::resource('messages', 'MessageController');
    Route::resource('promotions', 'PromotionController');
    Route::resource('visitors', 'ViewController');
  });
