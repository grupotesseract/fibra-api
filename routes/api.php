<?php

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Somente Logado e ROLE ADMIN|TECNICO)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:api', 'role:admin|tecnico']], function () {
    Route::apiResource('usuarios', 'UsuarioAPIController')->except(['destroy', 'store']);

    Route::apiResource('tipos_materiais', 'TipoMaterialAPIController');
    Route::apiResource('empresas', 'EmpresaAPIController');
    Route::apiResource('plantas', 'PlantaAPIController');
    Route::apiResource('itens', 'ItemAPIController');
    Route::apiResource('programacoes', 'ProgramacaoAPIController');
    Route::apiResource('potencias', 'PotenciaAPIController');
    Route::apiResource('tensoes', 'TensaoAPIController');
    Route::apiResource('liberacoes_documentos', 'LiberacaoDocumentoAPIController');

    Route::apiResource('materiais', 'MaterialAPIController')->only([
        'store', 'update', 'destroy',
    ]);

    Route::get('sync/plantas', 'PlantaAPIController@syncPlantas');
});

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (Somente Logado e ROLE ADMIN|TECNICO|CLIENTE)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:api', 'role:admin|tecnico|cliente']], function () {
    Route::get('usuario', 'UsuarioAPIController@showAuthenticated');

    Route::apiResource('materiais', 'MaterialAPIController')->only([
        'index', 'show',
    ]);
});

/*
|--------------------------------------------------------------------------
| Rotas Livres
|--------------------------------------------------------------------------
*/
Route::post('/login', 'UsuarioAPIController@login');

/* Rota caso permissões insuficientes  **/
Route::get('acesso-negado', function () {
    return response()->json([
        'success'=>false,
        'data'=>[],
        'message' => 'Usuário não possui as permissões necessárias.',
    ], 403);
});

/* Caso rota não encontrada **/
Route::fallback(function () {
    return response()->json([
        'success'=>false,
        'data'=>[],
        'message' => 'Rota não encontrada',
    ], 404);
});

Route::resource('usuarios_liberacoes', 'UsuarioLiberacaoAPIController');
Route::resource('quantidades_minimas', 'QuantidadeMinimaAPIController');
Route::resource('estoques', 'EstoqueAPIController');
Route::resource('quantidades_substituidas', 'QuantidadeSubstituidaAPIController');
