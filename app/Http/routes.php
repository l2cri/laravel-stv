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
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('auth.post');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/*
 * Панель
 */

Route::group(['as' => 'panel::','middleware' => 'auth'], function () {
    Route::get('/panel', function () {
        return view('panel.index');
    })->name('panel.index');

    // sections

    Route::get('/panel/supplier/sections', 'SectionController@index')->name('sections');
    Route::post('/panel/supplier/sections/add', 'SectionController@store');
    Route::get('/panel/supplier/sections/delete/{id}', 'SectionController@delete')->name('sections.delete');

    // products

    Route::get('/panel/supplier/products', 'ProductController@index')->name('products');
    Route::get('/panel/supplier/products/add', 'ProductController@addform')->name('products.addform');
    Route::post('/panel/supplier/products/add', 'ProductController@store')->name('products.store');

    // orders

    Route::get('/panel/supplier/order/{id}', 'OrderController@supplierorder')->name('ordersupplier.page');

});

/*
 * Datatables
 */

Route::resource('/panel/supplier/products/datatables', 'ProductController',
    ['names' => ['index' => 'products.datatables']]);

Route::resource('/panel/supplier/orderdatatables', 'OrderController',
    ['names' => ['index' => 'orders.datatables']]);

/*
 * Контент
 */
Route::get('info/{code}', 'InfopageController@byCode')->where('code', '[A-Za-z0-9\-\_]+');

/*
 * Каталог
 */

Route::get('catalog/{code}', 'CatalogController@byCode')->where('code', '[A-Za-z0-9\-\_]+')->name('section.page');
Route::get('catalog/product/{id}', 'CatalogController@product')->where('id', '[0-9]+')->name('product.page');
Route::post('catalog/ajax', 'CatalogController@ajax')->name('catalog.ajax'); // TODO: add validation for all params

/*
 * Корзина
 */
Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('/cart/ajax/add', 'CartController@add')->name('cart.add');
Route::post('/cart/ajax/update', 'CartController@update')->name('cart.update');
Route::get('/cart/delete/{id}', 'CartController@delete')->where('id', '[0-9]+')->name('cart.delete');
Route::get('/cart/ajax/dropdown', 'CartController@dropdown');
Route::get('/cart/ajax/total', 'CartController@total');

/*
 * Заказ
 */
Route::get('order/checkout', 'OrderController@checkout')->name('order.checkout'); // форма создания заказа одна, на трех вкладках если нужно
Route::post('order/create', 'OrderController@create')->name('order.create');
Route::get('order/thanks', 'OrderController@thanks')->name('order.thanks');