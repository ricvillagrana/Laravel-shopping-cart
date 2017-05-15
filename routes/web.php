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

Route::get('/cotizacion', 'CotizacionesController@index');
Route::get('/cotizacion	/nueva', 'CotizacionesController@index');


// Ajax
//Route::get('/ajax/addCart/{id}', 'ShoppingCart@addProduct');
Route::get('/ajax/addCart/{id}/{cant}', 'ShoppingCart@addProduct');
Route::get('/ajax/delCart', 'ShoppingCart@delCart');
Route::get('/ajax/editProduct/{id}/{cant}', 'ShoppingCart@editProduct');
Route::get('/ajax/deleteProduct/{id}', 'ShoppingCart@deleteProduct');


