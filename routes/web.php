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

Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/addtask', 'HomeController@addtask');
Route::get('/complete/{id}', 'HomeController@complete');
Route::get('/delete/{id}', 'HomeController@remove');
Route::get('/view/{id}', 'HomeController@task');
