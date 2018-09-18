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

Route::get('/painel/produtos/tests', 'Painel\ProdutoController@tests');
Route::resource('/painel/produtos', 'Painel\ProdutoController');



Route::group(['namespace' => 'Site'], function ()
{
    Route::get('/categoria/{id}', 'SiteController@categoria'); 
    Route::get('/categoria2/{id?}', 'SiteController@categoriaOp'); 

    Route::get('/', 'SiteController@index');
    Route::get('/contato', 'SiteController@contato');

});