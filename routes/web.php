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

Route::get('/', 'RemaxController@start')->name('starts');
Route::get('propiedades', 'RemaxController@properties')->name('propiedades');
Route::get('propiedades/{property}', 'RemaxController@property')->name('propiedad');

Route::get('properties/sync', 'PropertyController@sync')->name('properties.sync');
Route::resources([
    'properties' => 'PropertyController',
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
