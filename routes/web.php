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

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('usuarios', 'UsuarioController');
});

Route::get('/estados/{id}/cidades', 'CidadeController@getPorEstado');
Route::get('/empresas/{id}/plantas', 'PlantaController@getPorEmpresa');

Route::resource('tiposMateriais', 'TipoMaterialController');
Route::resource('empresas', 'EmpresaController');
Route::resource('plantas', 'PlantaController');
Route::resource('materiais', 'MaterialController');
Route::resource('potencias', 'PotenciaController');
Route::resource('tensoes', 'TensaoController');
Route::resource('itens', 'ItemController');
Route::resource('programacoes', 'ProgramacaoController');
