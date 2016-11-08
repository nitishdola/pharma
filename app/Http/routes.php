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


Route::get('/', ['uses' => 'HomeController@index', 'as' => 'dashboard', 'middleware' => 'auth' ]);

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['prefix'=>'company'], function() {
    Route::get('/create', [
        'as' => 'company.create',
        'middleware' => ['auth'],
        'uses' => 'CompaniesController@create'
    ]);
    Route::post('/store', [
        'as' => 'company.store',
        'middleware' => ['auth'],
        'uses' => 'CompaniesController@store'
    ]);
});


Route::group(['prefix'=>'product'], function() {
    Route::get('/add', [
        'as' => 'product.create',
        'middleware' => ['auth'],
        'uses' => 'ProductsController@create'
    ]);
    Route::post('/store', [
        'as' => 'product.store',
        'middleware' => ['auth'],
        'uses' => 'ProductsController@store'
    ]);

    Route::get('/view-all', [
        'as' => 'product.index',
        'middleware' => ['auth'],
        'uses' => 'ProductsController@index'
    ]);

    Route::get('/edit/{num}', [
        'as' => 'product.edit',
        'middleware' => ['auth'],
        'uses' => 'ProductsController@edit'
    ]);
    Route::post('/update/{num}', [
        'as' => 'product.update',
        'middleware' => ['auth'],
        'uses' => 'ProductsController@update'
    ]);
});


Route::group(['prefix'=>'stock'], function() {
    Route::get('/receive', [
        'as' => 'stock.receive',
        'middleware' => ['auth'],
        'uses' => 'StockInController@receive'
    ]);
    Route::post('/store', [
        'as' => 'stock.store',
        'middleware' => ['auth'],
        'uses' => 'StockInController@store'
    ]);

    Route::get('/receipt/{stock_in_id}', [
        'as' => 'stock.receipt',
        'middleware' => ['auth'],
        'uses' => 'StockInController@view_bill'
    ]);
});
