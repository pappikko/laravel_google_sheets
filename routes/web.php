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
    dd(__DIR__);
    return view('welcome');
});

Route::get('test', 'GoogleSheetsController@index');
Route::get('get_values', 'GoogleSheetsController@getValues');
Route::get('fetchTableDefFromDb', 'DbManageController@fetchTableDefFromDb');
Route::get('wright', 'DbManageController@wright');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
