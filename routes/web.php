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

Route::get('/', 'ProductosController@index');
Route::get('/productos', 'ProductosController@index');
Route::get('/productos/ver/{id}', 'ProductosController@showProducto');
Route::get('/productos/lista', 'ProductosController@index');
Route::get('/productos/carrito', 'ProductosController@showCart');
Route::get('/productos/categoria/{id}', 'ProductosController@showCategoria');
Route::get('/productos/{categoria}', 'ProductosController@viewCategorie');
Route::get('/productos/buscar/{query}', 'ProductosController@search');

Route::get('/cotizacion', 'CotizacionesController@index');
Route::get('/cotizacion/nueva', 'CotizacionesController@index');

// Routes para el cliente
Route::get('/cliente','ClientesController@index');
Route::get('/cliente/signin','ClientesController@signin');
Route::get('/cliente/profile','ClientesController@index');
Route::get('/cliente/signup','ClientesController@signup');
Route::get('/cliente/update','ClientesController@update');
Route::get('/cliente/delete','ClientesController@delete');
Route::get('/cliente/signout','ClientesController@signout');

Route::post('/cliente/login','ClientesController@login');
Route::post('/cliente/create','ClientesController@create');

// Ajax
//Route::get('/ajax/addCart/{id}', 'ShoppingCart@addProduct');
Route::get('/ajax/addCart/{id}/{cant}', 'ShoppingCart@addProduct');
Route::get('/ajax/delCart', 'ShoppingCart@delCart');
Route::get('/ajax/editProduct/{id}/{cant}', 'ShoppingCart@editProduct');
Route::get('/ajax/deleteProduct/{id}', 'ShoppingCart@deleteProduct');
Route::get('/ajax/getRank/{id}','ProductosController@getRank');
// Administration routes
// 


CRUD::resource('tag', 'TagCrudController');
Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
   CRUD::resource('tag', 'TagCrudController');
});
Route::group(['prefix' => config('backpack.base.route_prefix', 'admin'), 'middleware' => ['web', 'auth']], function () {
    CRUD::resource('productos', 'Admin\ProductosCrudController');
});
Route::group(['prefix' => config('backpack.base.route_prefix', 'admin'), 'middleware' => ['web', 'auth']], function () {
    CRUD::resource('categorias', 'Admin\CategoriasCrudController');
});