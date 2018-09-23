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

Route::middleware('auth')->group(function() {

  Route::get('/avatar', 'UsersController@avatar')->name('avatar');

  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('logo', 'UsersController@logo')->name('logo');

  Route::get('lockscreen', 'LockAccountController@lockscreen')->name('lockscreen');
  Route::post('lockscreen', 'LockAccountController@unlock')->name('post_lockscreen');

  Route::prefix('admin')->group(function() {

    Route::resource('companies', 'EmpresasController');
    Route::resource('users', 'UsersController');

  });

  Route::prefix('company')->group(function() {

    Route::get('config/company', 'EmpresasController@configsEmpresa')->name('config_empresa');

    Route::resource('clients', 'ClientesController');
    Route::resource('vendors', 'FornecedoresController');
    Route::resource('employees', 'FuncionariosController');
    Route::resource('products', 'ProdutosController');
    Route::resource('groups', 'GruposController');
    Route::resource('extras', 'ExtrasController');

    Route::resource('values', 'ValoresVendaController');

  });

});
