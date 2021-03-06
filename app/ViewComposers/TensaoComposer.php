<?php

namespace App\ViewComposers;

use App\Repositories\TensaoRepository;
use Illuminate\View\View;

class TensaoComposer
{
    protected $tensaoRepository;

    /**
     * __construct.
     *
     * @param TensaoRepository $tensaoRepository
     */
    public function __construct(TensaoRepository $tensaoRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->tensaoRepository = $tensaoRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tensoes', $this->tensaoRepository->getArrayParaSelect());
    }
}
