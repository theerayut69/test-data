<?php

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

Route::get('leagues', 'LeaguesController@index');

// Route::get('/home', 'HomeController@index')->name('home');

Route::post('leagues/create', 'LeaguesController@create')->name('league-create');

Route::get('leagues/create', 'LeaguesController@createForm')->name('league-form');

Route::delete('/leagues/{id}', 'LeaguesController@destroy');

