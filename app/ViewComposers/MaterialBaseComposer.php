<?php

namespace App\ViewComposers;

use App\Repositories\MaterialRepository;
use Illuminate\View\View;

class MaterialBaseComposer
{
    protected $materialRepository;

    /**
     * __construct.
     *
     * @param MaterialRepository $materialRepository
     */
    public function __construct(MaterialRepository $materialRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->materialRepository = $materialRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('materiais', $this->materialRepository->getArrayNomePotenciaTensaoParaSelect());
    }
}
