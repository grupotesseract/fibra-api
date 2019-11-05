<?php

namespace App\ViewComposers;

use App\Repositories\EstadoRepository;
use Illuminate\View\View;

class EstadoComposer
{
    protected $estadoRepository;

    /**
     * __construct.
     *
     * @param EstadoRepository $estadoRepository
     */
    public function __construct(EstadoRepository $estadoRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->estadoRepository = $estadoRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('estados', $this->estadoRepository->getArrayParaSelect());
    }
}
