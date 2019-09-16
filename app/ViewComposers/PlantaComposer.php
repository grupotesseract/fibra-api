<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use App\Repositories\PlantaRepository;

class PlantaComposer
{
    protected $plantaRepository;

    /**
     * __construct.
     *
     * @param PlantaRepository $plantaRepository
     */
    public function __construct(PlantaRepository $plantaRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->plantaRepository = $plantaRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('plantas', $this->plantaRepository->getArrayParaSelect());
    }
}
