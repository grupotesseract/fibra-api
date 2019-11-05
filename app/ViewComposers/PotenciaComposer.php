<?php

namespace App\ViewComposers;

use App\Repositories\PotenciaRepository;
use Illuminate\View\View;

class PotenciaComposer
{
    protected $potenciaRepository;

    /**
     * __construct.
     *
     * @param PotenciaRepository $potenciaRepository
     */
    public function __construct(PotenciaRepository $potenciaRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->potenciaRepository = $potenciaRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('potencias', $this->potenciaRepository->getArrayParaSelect());
    }
}
