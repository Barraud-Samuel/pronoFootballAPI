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

//List matchs

Route::get('matchs', 'MatchController@index');

//List single matchs
Route::get('matchs/{id}', 'MatchController@show');

//create new match
Route::post('matchs', 'MatchController@store');

//update match
Route::put('matchs', 'MatchController@store');

//delete match
Route::delete('matchs/{id}', 'MatchController@destroy');
