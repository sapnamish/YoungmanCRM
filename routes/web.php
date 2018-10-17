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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('project', 'ProjectController');

Route::resource('contractor', 'ContractorController');

Route::resource('package', 'PackageController');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/projectsJson', 'ProjectController@allJson')->name('projectsJson');
