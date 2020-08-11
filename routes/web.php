<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Auth::routes();

Route::get('/', 'ListingController@index')->name('listings');
Route::get('/{id}', 'ListingController@show')->name('listing');
//Route::get('/home', 'HomeController@index')->name('home');


