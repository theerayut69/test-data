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

Route::get('/', 'MainController@getLeagueDefault');

Route::get('league', 'LeagueController@index');
Route::get('league/create', 'LeagueController@createForm')->name('league-form');
Route::post('league/create', 'LeagueController@create')->name('league-create');
Route::get('/league/{id}/view', 'LeagueController@show');
Route::get('/league/{id}', 'LeagueController@destroy')->name('league-delete');
Route::get('league/update/{id}', 'LeagueController@edit')->name('league-edit');
Route::PATCH('/league/update/{id}', 'LeagueController@update')->name('league-update');

Route::get('team', 'TeamController@index');
Route::get('team/form', 'TeamController@createForm');
Route::post('team/create', 'TeamController@create');
Route::get('team/edit/{id}', 'TeamController@edit');
Route::get('team/delete/{id}', 'TeamController@destroy');
Route::get('/team/{id}/view', 'TeamController@show');
Route::patch('team/update/{id}', 'TeamController@update')->name('team-update');
Route::get('team/{id}/player', 'TeamController@getPlayer');
Route::get('/ajax-team', 'TeamController@ajax');
Route::get('/ajax-fixture/{id}', 'TeamController@ajaxFixture');
Route::get('/ajax-change-home-team', 'TeamController@ajaxChangeHomeTeam');
Route::any('/team/search', 'TeamController@search');

Route::get('player', 'PlayerController@index');
Route::get('player/form', 'PlayerController@createForm');
Route::post('player/create', 'PlayerController@create');
Route::get('player/edit/{id}', 'PlayerController@edit');
Route::get('player/{id}/view', 'PlayerController@show');
Route::get('player/delete/{id}', 'PlayerController@destroy');
Route::patch('player/update/{id}', 'PlayerController@update')->name('player-update');

Route::get('fixture', 'FixtureController@index');
Route::get('fixture/form', 'FixtureController@createForm');
Route::post('fixture/create', 'FixtureController@create');
Route::get('fixture/edit/{id}', 'FixtureController@edit');
Route::get('fixture/delete/{id}', 'FixtureController@destroy');
Route::patch('fixture/update/{id}', 'FixtureController@update');
