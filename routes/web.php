<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    /** Show Task Dashboard*/
    Route::get('/todo', 'TasksController@index');

    /** Add New Task*/
    Route::post('/todo/task', 'TasksController@store');

    /** Delete Task*/
    Route::post('/todo/task/{id}', 'TasksController@destroy');

    /** Show Task Dashboard*/
    Route::get('/todo2', 'Tasks2Controller@index');

    /** Add New Task*/
    Route::post('/todo2/task', 'Tasks2Controller@store');

    /** Delete Task*/
    Route::delete('/todo2/task/{id}', 'Tasks2Controller@destroy');
});

