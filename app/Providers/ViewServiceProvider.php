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
        View::composer('tipos_materiais.select', '\App\ViewComposers\TipoMaterialComposer');
    }
}
