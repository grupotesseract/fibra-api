<?php

namespace App\ViewComposers;

use App\Repositories\EmpresaRepository;
use Illuminate\View\View;

class EmpresaComposer
{
    protected $empresaRepository;

    /**
     * __construct.
     *
     * @param EmpresaRepository $empresaRepository
     */
    public function __construct(EmpresaRepository $empresaRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->empresaRepository = $empresaRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('empresas', $this->empresaRepository->getArrayParaSelect());
    }
}
