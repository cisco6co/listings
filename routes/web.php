<?php

use Illuminate\Support\Facades\Auth;
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

Route::middleware('doNotCacheResponse')->group(function () {
    Auth::routes();

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/listing/create', 'ListingController@create')->name('listings.create');
    Route::get('/api/listings', 'ListingController@index')->name('listings');
    Route::get('/api/categories', 'CategoryController@index')->name('categories');
    Route::get('/api/listings/prices', 'ListingPriceController')->name('listings.prices');
});

Route::get('/listing/{listing}', 'ListingController@show')->name('listings.show');
