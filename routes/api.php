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

Route::get('/game/{id}/state', 'GameController@getRoomState');
Route::get('/game/{id}/flip/{x}/{y}', 'GameController@flip');
Route::get('/game/{id}/turn', 'GameController@turn');
