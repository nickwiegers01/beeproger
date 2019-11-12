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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

        Route::group([ 'as' => 'task.' ], function (){
            Route::get('/', 'TasksController@index')->name('index');
            Route::get('/edit/{tasks}', 'TasksController@edit')->name('edit');
            Route::get('/destroy/{tasks}', 'TasksController@destroy')->name('destroy');
            Route::post('/store', 'TasksController@store')->name('store');
            Route::get('/show/{tasks}', 'TasksController@show')->name('show');
            Route::post('/update/{tasks}', 'TasksController@update')->name('update');
            Route::get('/getTasks', 'TasksController@getTasks')->name('getTasks');
        });
});


