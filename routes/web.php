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
    return redirect('/game/room/1');
});

Route::get('/game/room/{id}', function ($id) {
    return view('game', compact('id'));
});

Route::get('/env', function () {
    print App::environment();
});