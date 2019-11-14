<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('estados.select', '\App\ViewComposers\EstadoComposer');
        View::composer('cidades.select', '\App\ViewComposers\CidadeComposer');
        View::composer('empresas.select', '\App\ViewComposers\EmpresaComposer');
        View::composer('plantas.select', '\App\ViewComposers\PlantaComposer');
        View::composer('plantas.show_quantidades_minimas', '\App\ViewComposers\MaterialComposer');
        View::composer('tipos_materiais.select', '\App\ViewComposers\TipoMaterialComposer');
        View::composer('materiais.select_reatores', '\App\ViewComposers\MaterialReatorComposer');
        View::composer('materiais.select_bases', '\App\ViewComposers\MaterialBaseComposer');
        View::composer('itens.show', '\App\ViewComposers\MaterialComposer');
        View::composer('itens.edit-quantidade-material', '\App\ViewComposers\MaterialComposer');
        View::composer('programacoes.show_estoque', '\App\ViewComposers\MaterialComposer');
        View::composer('programacoes.show_entradas_materiais', '\App\ViewComposers\MaterialComposer');
        View::composer('programacoes.show_quantidades_substituidas', '\App\ViewComposers\MaterialComposer');
        View::composer('programacoes.show_quantidades_substituidas', '\App\ViewComposers\ItensProgramacaoComposer');
        View::composer('potencias.select', '\App\ViewComposers\PotenciaComposer');
        View::composer('tensoes.select', '\App\ViewComposers\TensaoComposer');
    }
}
