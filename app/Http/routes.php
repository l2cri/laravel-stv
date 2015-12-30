<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//$app['admin.auth'] = $app['auth'];

Route::get('/test', function() {
    $ts = \App\Models\Infopage::find(1);
    var_dump($ts->created_at->timestamp);
});


Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/*
 * Панель
 */

Route::group(['as' => 'panel::','middleware' => 'auth'], function () {
    Route::get('/panel', function () {
        return view('panel.index');
    });

    Route::get('/panel/supplier/sections', 'SectionController@index')->name('sections');
    Route::post('/panel/supplier/sections/add', 'SectionController@store');
    Route::get('/panel/supplier/sections/delete/{id}', 'SectionController@delete')->name('sections.delete');
});

/*
 * Контент
 */
Route::get('info/{code}', 'InfopageController@byCode')->where('code', '[A-Za-z0-9\-\_]+');