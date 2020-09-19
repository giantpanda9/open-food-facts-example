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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/openFoodFacts', 'openFoodFactsController@correctStartPath');
Route::get('/openFoodFacts/{pageNo}/', 'openFoodFactsController@getData');
Route::get('/openFoodFacts/{pageNo}/{productName}/', 'openFoodFactsController@getData');
Route::get('/openFoodFactStored/{pageNo}/{productName}/}', 'openFoodFactsController@getDataStored');
Route::get('/openFoodFactUpdated/{pageNo}/{productName}/}', 'openFoodFactsController@getDataUpdated');
Route::get('/openFoodFactStorageError/{pageNo}/{productName}/}', 'openFoodFactsController@getDataError');
Route::get('/openFoodFactStored/{pageNo}/', 'openFoodFactsController@getDataStored');
Route::get('/openFoodFactUpdated/{pageNo}/', 'openFoodFactsController@getDataUpdated');
Route::get('/openFoodFactStorageError/{pageNo}/', 'openFoodFactsController@getDataError');
Route::post('/dispatch', 'openFoodFactsController@dispatcher');
Route::post('/store', 'openFoodFactsController@storeItem');
