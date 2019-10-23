<?php

/*
|--------------------------------------------------------------------------
| Rotas Livres
|--------------------------------------------------------------------------
*/
Auth::routes(['register' => false]);
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Somente Logado & ROLE ADMIN)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/home', 'HomeController@index');
    Route::get('/estados/{id}/cidades', 'CidadeController@getPorEstado');
    Route::get('/empresas/{id}/plantas', 'PlantaController@getPorEmpresa');

    Route::resource('usuarios', 'UsuarioController');
    Route::resource('tiposMateriais', 'TipoMaterialController');
    Route::resource('empresas', 'EmpresaController');
    Route::resource('plantas', 'PlantaController');
    Route::resource('materiais', 'MaterialController');
    Route::resource('itens', 'ItemController');
    Route::post('itens/{id}/materiais', 'ItemController@postAssociarMaterial')->name('itens.associarMaterial');
    Route::delete('itens/{id_item}/materiais/{id_material}', 'ItemController@postDesassociarMaterial')->name('itens.desassociarMaterial');
    Route::resource('programacoes', 'ProgramacaoController');
    Route::get('programacoes/{id}/liberacoes-documentos', 'ProgramacaoController@getLiberacoesDocumentos')->name('programacoes.liberacoesDocumentos');
    Route::resource('potencias', 'PotenciaController');
    Route::resource('tensoes', 'TensaoController');
    Route::resource('liberacoesDocumentos', 'LiberacaoDocumentoController');
    Route::resource('usuariosLiberacoes', 'UsuarioLiberacaoController');
    Route::resource('quantidadesMinimas', 'QuantidadeMinimaController');
});
