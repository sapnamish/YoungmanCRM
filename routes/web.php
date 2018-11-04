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

Route::resource('pmc', 'PmcController');

Route::resource('client', 'ClientController');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/projectsJson', 'ProjectController@allJson')->name('projectsJson');

Route::get('searchPMC',
    [
        'as'=>'searchPMC',
        'uses'=>'PmcController@search'
    ]);

Route::post('attachPMC',
    [
        'as'=>'attachPMC',
        'uses'=>'ProjectController@attachPMC'
    ]);

Route::get('searchClient',
    [
        'as'=>'searchClient',
        'uses'=>'ClientController@search'
    ]);

Route::post('attachClient',
    [
        'as'=>'attachClient',
        'uses'=>'ProjectController@attachClient'
    ]);

Route::get('updateProjectStatus',
    [
        'as'=>'updateProjectStatus',
        'uses'=>'ProjectController@updateStatus'
    ]);

Route::get('searchContractor',
    [
        'as'=>'searchContractor',
        'uses'=>'ContractorController@search'
    ]);

Route::post('attachContractorToPackage',
    [
        'as'=>'attachContractorToPackage',
        'uses'=>'PackageController@attachContractor'
    ]);

Route::get('searchProject',
    [
        'as'=>'searchProject',
        'uses'=>'ProjectController@search'
    ]);

Route::post('attachProjectToPackage',
    [
        'as'=>'attachProjectToPackage',
        'uses'=>'PackageController@attachProject'
    ]);