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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'client'], function () {
    Route::get('/get', 'ApiDataController@get');
    Route::post('/insert', 'ApiDataController@insert');
    Route::post('/update', 'ApiDataController@update');
    Route::post('/delete', 'ApiDataController@delete');
    Route::get('/section/{section}', 'ApiDataController@section');
    Route::get('/search/all', 'ApiDataController@searchAll');
    Route::get('/search/{section}', 'ApiDataController@searchBySection');
    Route::get('/related/all', 'ApiDataController@searchRelatedAll');
    Route::get('/related/section', 'ApiDataController@searchRelatedBySection');
    Route::get('/contents', 'ApiDataController@feedContent');
});
