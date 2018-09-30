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

Route::get('/image/external', 'ImagensController@image')->name('image');

Auth::routes();

Route::middleware('auth')->group(function() {

  Route::get('/avatar', 'UsersController@avatar')->name('avatar');

  Route::get('logo', 'UsersController@logo')->name('logo');

  Route::get('lockscreen', 'LockAccountController@lockscreen')->name('lockscreen');
  Route::post('lockscreen', 'LockAccountController@unlock')->name('post_lockscreen');

  Route::post('/produtos/imagem/remove/{id}', "ProdutosController@imagemRemove")->name('produto_imagem_remove');
  Route::post('/produtos/fornecedor/remove/{id}', "ProdutosController@fornecedorRemove")->name('produto_fornecedor_remove');

  Route::get('/', 'HomeController@index')->name('home');

  Route::prefix('admin')->group(function() {

    Route::resource('companies', 'EmpresasController');
    Route::resource('users', 'UsersController');
    Route::resource('configs', 'ConfigController');

    Route::get('/', 'HomeController@index')->name('home_admin');

  });

  Route::prefix('company')->group(function() {

    Route::get('config/company', 'EmpresasController@configsEmpresa')->name('config_empresa');

    Route::get('/', 'HomeController@index')->name('home_company');

    Route::resource('clients', 'ClientesController');
    Route::resource('vendors', 'FornecedoresController');
    Route::resource('employees', 'FuncionariosController');
    Route::resource('products', 'ProdutosController');
    Route::resource('groups', 'GruposController');
    Route::resource('extras', 'ExtrasController');

    Route::resource('values', 'ValoresVendaController');

    Route::get('/fornecedores/ajax', 'FornecedoresController@toAjax')->name('fornecedores');

  });

});
