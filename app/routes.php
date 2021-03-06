<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

//Search api
Route::get("/barkpark/v1/search", "SearchController@index");

//Park api
Route::post("/barkpark/v1/park", "ParkController@index");  //Save Park