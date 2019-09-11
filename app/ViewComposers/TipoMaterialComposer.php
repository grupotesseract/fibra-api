<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Repositories\TipoMaterialRepository;

class TipoMaterialComposer
{
    protected $tipoMaterialRepository;

    /**
     * __construct.
     *
     * @param TipoMaterialRepository $tipoMaterialRepository
     */
    public function __construct(TipoMaterialRepository $tipoMaterialRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->tipoMaterialRepository = $tipoMaterialRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tipos_materiais', $this->tipoMaterialRepository->getArrayParaSelect());
    }
}
