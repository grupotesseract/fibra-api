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

    Route::resource('plantas', 'PlantaController');
    Route::get('plantas/{id}/itens', 'PlantaController@getItensPlanta')
        ->name('plantas.itens');
    Route::get('plantas/{id}/programacoes', 'PlantaController@getProgramacoesPlanta')
        ->name('plantas.programacoes');
    Route::get('plantas/{id}/quantidades-minimas', 'PlantaController@getQuantidadesMinimasPlanta')
        ->name('plantas.quantidadesMinimas');
    Route::post('plantas/{id}/quantidades-minimas', 'PlantaController@postQuantidadesMinimasPlanta')
        ->name('plantas.addQuantidadesMinimas');

    Route::resource('itens', 'ItemController');
    Route::post('itens/{id}/materiais', 'ItemController@postAssociarMaterial')
        ->name('itens.associarMaterial');
    Route::delete('itens/{id_item}/materiais/{id_material}', 'ItemController@postDesassociarMaterial')->name('itens.desassociarMaterial');
    Route::get('itens/{id_item}/materiais/{id_material}/edit', 'ItemController@getEditarQuantidadeMaterial')->name('itens.materiais.edit');
    Route::put('itens/{id_item}/materiais/{id_material}/edit', 'ItemController@putEditarQuantidadeMaterial')->name('itens.materiais.update');

    Route::resource('programacoes', 'ProgramacaoController');
    Route::get('programacoes/{id}/liberacoes-documentos', 'ProgramacaoController@getLiberacoesDocumentos')
        ->name('programacoes.liberacoesDocumentos');
    Route::get('programacoes/{id}/estoque', 'ProgramacaoController@getGerenciarEstoque')
        ->name('programacoes.estoque');
    Route::post('programacoes/{id}/estoque', 'ProgramacaoController@postAdicionarEstoque')
        ->name('programacoes.addEstoque');
    Route::get('programacoes/{id}/entrada-materiais', 'ProgramacaoController@getEntradasMateriais')
        ->name('programacoes.entradasMateriais');
    Route::post('programacoes/{id}/entrada-materiais', 'ProgramacaoController@postAdicionarEntradaMaterial')
        ->name('programacoes.addEntradaMaterial');
    Route::get('programacoes/{id}/quantidades-substituidas', 'ProgramacaoController@getQuantidadesSubstituidas')
        ->name('programacoes.quantidadesSubstituidas');
    Route::post('programacoes/{id}/quantidades-substituidas', 'ProgramacaoController@postQuantidadesSubstituidas')
        ->name('programacoes.addQuantidadesSubstituidas');

    Route::resource('usuarios', 'UsuarioController');
    Route::resource('tiposMateriais', 'TipoMaterialController');
    Route::resource('empresas', 'EmpresaController');
    Route::resource('materiais', 'MaterialController');
    Route::resource('entradasMateriais', 'EntradaMaterialController');
    Route::resource('potencias', 'PotenciaController');
    Route::resource('tensoes', 'TensaoController');
    Route::resource('liberacoesDocumentos', 'LiberacaoDocumentoController');
    Route::resource('usuariosLiberacoes', 'UsuarioLiberacaoController');
    Route::resource('quantidadesMinimas', 'QuantidadeMinimaController');
    Route::resource('estoque', 'EstoqueController');
    Route::resource('quantidadesSubstituidas', 'QuantidadeSubstituidaController');

    Route::get('export/programacao/{programacao_id}', 'ProgramacaoController@export');
});
