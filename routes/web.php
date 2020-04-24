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
    Route::get('plantas/{id}/manutencoes-civil-eletrica', 'PlantaController@getManCivilEletricaPlanta')
        ->name('plantas.manutencoesCivilEletrica');

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

    Route::post('/programacoes/{id}/relatorio-quantidades', 'RelatorioQuantidadeController@confereExisteRelatorio')
        ->name('programacoes.relatorioQuantidade');
    Route::get('/programacoes/{id}/relatorio-quantidades-download', 'RelatorioQuantidadeController@downloadRelatorio')
        ->name('relatorioQuantidade.download');

    Route::post('/programacoes/{id}/relatorio-fotos', 'RelatorioFotograficoController@confereRelatorioFotos')
        ->name('programacoes.relatorioFotos');
    Route::get('/programacoes/{id}/relatorio-fotos/delete', 'RelatorioFotograficoController@deleteRelatorioFotos')
        ->name('programacoes.deleteRelatorioFotos');
    Route::get('/programacoes/{id}/relatorio-quantidades/delete', 'RelatorioQuantidadeController@deleteRelatorioQuantidades')
        ->name('programacoes.deleteRelatorioQuantidades');
    Route::get('/programacoes/{id}/relatorio-fotos-download', 'RelatorioFotograficoController@downloadRelatorioFotos')
        ->name('relatorioFotografico.download');

    Route::get('/plantas/rdo/{idRdo}/relatorio-download', 'ManutencaoCivilEletricaController@downloadRelatorio')
        ->name('relatorioRdo.download');

    Route::get('programacoes/{id}/comentarios', 'ProgramacaoController@getGerenciarComentarios')
        ->name('programacoes.comentarios');
    Route::get('programacoes/{id}/datasManutencoes', 'ProgramacaoController@getDatasManutencoes')
    ->name('programacoes.datasManutencoes');
    Route::post('programacoes/{id}/comentarios', 'ProgramacaoController@postGerenciarComentarios')
        ->name('programacoes.comentarios');
    Route::get('programacoes/{id}/comentarios-gerais', 'ProgramacaoController@getGerenciarComentariosGerais')
        ->name('programacoes.comentariosGerais');
    Route::post('programacoes/{id}/comentarios-gerais', 'ProgramacaoController@postGerenciarComentariosGerais')
        ->name('programacoes.comentariosGerais');

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
    Route::resource('comentarios', 'ComentarioController');
    Route::resource('comentariosGerais', 'ComentarioGeralController');
    Route::resource('datasManutencoes', 'DataManutencaoController');
    Route::resource('manutencoesCivilEletrica', 'ManutencaoCivilEletricaController');
    Route::resource('usuariosManutencoes', 'UsuarioManutencaoController');

    Route::resource('atividadesRealizadas', 'AtividadeRealizadaController');
});


Route::resource('itensAlterados', 'ItemAlteradoController');