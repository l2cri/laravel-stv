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

    $locationRepo = new \App\Repo\Location\LocationRepo(new \App\Models\Location(), new \App\Models\Supplier(), app('request'));
    var_dump($locationRepo->getSessionLocation());
});


Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin')->name('login');
Route::post('auth/login', 'Auth\AuthController@postLogin')->name('auth.post');
Route::get('auth/logout', 'Auth\AuthController@getLogout')->name('logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister')->name('register');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::post('/order/checkout/register', 'Auth\AuthController@checkoutRegister')->name('checkout.register');

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
    Route::get('/panel/supplier/products/json/{supplierId}', 'ProductController@supplierProductsJson')->name('products.json');
    Route::get('/panel/supplier/products/add', 'ProductController@addform')->name('products.addform');
    Route::post('/panel/supplier/products/add', 'ProductController@store')->name('products.store');
    Route::post('/panel/supplier/products/update', 'ProductController@update')->name('products.update');
    Route::get('/panel/supplier/products/edit/{id}', 'ProductController@edit')->name('products.edit');
    Route::get('/panel/supplier/products/delete/{id}', 'ProductController@delete')->name('products.delete');
    Route::get('/panel/supplier/products/deleteimg/{id}', 'ProductController@deleteimg')->name('products.deleteimg');

    // orders

    Route::get('/panel/supplier/order/{id}', 'OrderController@supplierorder')->name('ordersupplier.page');
    Route::get('/panel/supplier/order/delete/{id}', 'OrderController@delete')->name('order.delete');
    Route::get('/panel/supplier/order/edit/{id}', 'OrderController@orderedit')->name('order.edit');
    Route::post('/panel/supplier/order/cart/add', 'OrderController@cartadd')->name('ordercart.add');
    Route::get('/panel/supplier/order/cart/delete', 'OrderController@cartdelete')->name('ordercart.delete');
    Route::get('/panel/supplier/order/{orderId}/condition/delete/{id}', 'OrderController@conditionDelete')->name('ordercondition.delete');
    Route::post('/panel/supplier/order/cart/update', 'OrderController@cartupdate')->name('ordercart.update');
    Route::post('/panel/supplier/order/update', 'OrderController@update')->name('order.update');
    Route::get('/panel/user/order/{id}', 'OrderController@userrorder')->name('userorder');
    Route::get('/panel/user/order/return/{id}', 'OrderController@returnOrder')->name('order.return');
    Route::get('/panel/user/order/repeat/{id}', 'OrderController@repeat')->name('order.repeat');
    Route::post('/panel/user/order/message/', 'OrderController@saveUserMessage')->name('order.saveUserMessage');
    Route::post('/panel/supplier/order/message/', 'OrderController@saveSupplierMessage')->name('order.saveSupplierMessage');

    Route::get('/panel/supplier/settings', 'SupplierController@settings')->name('supplier.settings');
    Route::post('/panel/supplier/settings/update', 'SupplierController@updateSettings')->name('supplier.settings.update');

    // profiles

    Route::get('/panel/user/profiles', 'ProfileController@index')->name('profiles');
    Route::post('/panel/user/profiles/add', 'ProfileController@add')->name('profile.add');
    Route::post('/panel/user/profiles/update', 'ProfileController@update')->name('profile.update');
    Route::get('/panel/user/profiles/update/{id}', 'ProfileController@updateform')->name('profile.show.update');
    Route::get('/panel/user/profiles/show/{id}', 'ProfileController@show')->name('profile.show');
    Route::get('/panel/user/profiles/delete/{id}', 'ProfileController@delete')->name('profile.delete');

    // company for corporate users
    Route::get('/panel/user/company', 'CompanyController@company')->name('company');
    Route::post('/panel/user/company', 'CompanyController@save')->name('company.save');
    Route::get('/panel/user/company/toggleProfile/{profileId}', 'CompanyController@toggleProfile')->name('company.toggleProfile');
    Route::get('/panel/user/company/toggleSupplier/{supplierId}', 'CompanyController@toggleSupplier')->name('company.toggleSupplier');


    // comments
    Route::get('/panel/supplier/comments','CommentController@getBySupplier')->name('comments.list');
    Route::get('/panel/supplier/comments/delete/{id}', 'CommentController@delete')->name('comment.delete');
    Route::get('/panel/supplier/comments/toggle/{id}', 'CommentController@toggle')->name('comment.toggle');

    Route::get('/panel/supplier/supplier-comments','CommentController@getSupplierComments')->name('supplierComments.list');
    Route::get('/panel/supplier/supplier-comments/delete/{id}', 'CommentController@deleteSupplierComments')->name('supplierComments.delete');
    Route::get('/panel/supplier/supplier-comments/toggle/{id}', 'CommentController@toggleSupplierComments')->name('supplierComments.toggle');

    //FAQ
    Route::get('/panel/supplier/faq','FaqController@getBySupplier')->name('faq.list');
    Route::get('/panel/supplier/faq/delete/{id}', 'FaqController@delete')->name('faq.delete');
    Route::get('/panel/supplier/faq/edit/{id}', 'FaqController@edit')->name('faq.edit');
    Route::post('/panel/supplier/faq/update/{id}', 'FaqController@update')->name('faq.update');

    //Favorite
    Route::post('panel/user/favorite/add','FavoriteController@favoriteProduct')->name('favorite-product.add');
    Route::get('panel/user/favorite','FavoriteController@favoriteList')->name('favorite-list');
    Route::post('panel/user/favorite/ajax', 'FavoriteController@ajax')->name('favorite-ajax');

    // Supplier
    Route::get('/panel/supplier/actions/', 'ActionController@index')->name('actions');
    Route::post('/panel/supplier/actions/add', 'ActionController@add')->name('actions.add');
    Route::get('/panel/supplier/actions/show/{id}', 'ActionController@show')->name('actions.show');
    Route::get('/panel/supplier/actions/update/{id}', 'ActionController@updateform')->name('actions.show.update');
    Route::post('/panel/supplier/actions/update', 'ActionController@update')->name('actions.update');
    Route::get('/panel/supplier/actions/delete/{id}', 'ActionController@delete')->name('actions.delete');
    Route::get('/panel/supplier/actions/associate/{id}', 'ActionController@associate')->name('actions.associate');
    Route::get('/panel/supplier/actions/disassociate/{id}', 'ActionController@disassociate')->name('actions.disassociate');
    Route::get('/panel/supplier/actions/{action_id}/product/{product_id}/remove', 'ActionController@removeProduct')->name('actions.removeProduct');

    // Locations
    Route::get('/panel/supplier/zones', 'LocationController@locationsTree')->name('location.zones');
    Route::post('/panel/supplier/zones', 'LocationController@saveDeliveryZone')->name('location.zones.save');
    Route::get('/panel/supplier/zones/ajax', 'LocationController@ajax')->name('location.zones.ajax');
});

/*
 * Datatables
 */

Route::resource('/panel/supplier/products/datatables', 'ProductController',
    ['names' => ['index' => 'products.datatables']]);

Route::resource('/panel/supplier/orderdatatables', 'OrderController',
    ['names' => ['index' => 'orders.datatables']]);

Route::controller('/panel/user/orders', 'OrderController', [
    'getUserOrders' => 'userorders.datatables',
]);

Route::controller('/panel/supplier/comments', 'CommentController', [
    'getBySupplier' => 'comments.datatables',
]);

Route::controller('/panel/supplier/supplier-comments', 'CommentController', [
    'getSupplierComments' => 'supplierComments.datatables',
]);

Route::controller('/panel/supplier/faq', 'FaqController', [
    'getBySupplier' => 'faq.datatables',
]);


/*
 * Контент
 */
Route::get('info/{code}', 'InfopageController@byCode')->where('code', '[A-Za-z0-9\-\_]+')->name('infopage');

/*
 * Новости
 */
Route::get('news', 'NewsController@index')->name('news.index');
Route::get('news/{id}', 'NewsController@byId')->where('id','[0-9]+')->name('news.detail');

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
Route::get('order/checkout', 'OrderController@checkout')->name('order.checkout')->middleware(['auth.checkout']); // форма создания заказа одна, на трех вкладках если нужно
Route::post('order/create', 'OrderController@create')->name('order.create');
Route::get('order/thanks', 'OrderController@thanks')->name('order.thanks');
Route::get('order/checkout/auth', 'OrderController@auth')->name('order.auth');

/*
 * Comments
 */
Route::post('catalog/product/{id}/addComment', 'CommentController@storeProduct')->where('id', '[0-9]+')->name('commentProduct.add');
Route::post('supplier/{id}/addComment', 'CommentController@storeSupplier')->where('id', '[0-9]+')->name('commentSupplier.add');
Route::get('catalog/product/{id}/pageComment', 'CommentController@paginatorProduct')->where('page','[0-9]+')->name('commentProduct.page');
Route::get('supplier/{id}/pageComment', 'CommentController@paginatorSupplier')->where('id', '[0-9]+')->name('commentSupplier.page');

/**
 * FAQ
 */
Route::post('catalog/product/{id}/addFaq', 'FaqController@store')->where('id', '[0-9]+')->name('faq.add');
Route::get('catalog/product/{id}/pageFaq', 'FaqController@paginator')->where('page','[0-9]+')->name('faq.page');

/*
 * Поставщик
 */
Route::get('supplier/{name}/about', 'SupplierController@about')->name('supplier.about');
Route::get('supplier/{name}/comments', 'SupplierController@comments')->name('supplier.comments');
Route::get('supplier/{name}/contacts', 'SupplierController@contacts')->name('supplier.contacts');
Route::post('supplier/{name}/contacts', 'SupplierController@feedback')->name('supplier.feedback');
Route::get('supplier/{name}/news', 'SupplierController@actions')->name('supplier.actions');
Route::get('supplier/{name}/{code?}', 'SupplierController@catalog')->name('supplier');
Route::post('supplier/{name}', 'SupplierController@ajax')->name('supplier.ajax');

// каталог поставщиков
Route::get('suppliers/{sectionCode?}', 'SupplierController@suppliers')->name('suppliers');
Route::post('suppliers/ajax', 'SupplierController@suppliersAjax')->name('suppliers.ajax');

/**
 * Rating Products
 */
Route::post('catalog/product/{id}/rate','CatalogController@rateProduct')->where('id','[0-9]+')->name('rating.rateProduct');
Route::post('supplier/{id}/rate','SupplierController@rateSupply')->where('id','[0-9]+')->name('rating.rateSupplier');

// Location typehead
Route::get('queryJson/{query}', 'LocationController@queryJson')->name('locationQuery');
Route::post('setLocation', 'LocationController@setLocation')->name('setLocation');

Route::get('search/products','SearchController@products')->name('search.products');
Route::get('search/suppliers','SearchController@suppliers')->name('search.suppliers');
