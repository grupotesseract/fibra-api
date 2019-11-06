<?php

namespace App\ViewComposers;

use App\Repositories\ItemRepository;
use App\Repositories\ProgramacaoRepository;
use Illuminate\View\View;

class ItensProgramacaoComposer
{
    protected $itemRepository;
    protected $programacaoRepository;

    /**
     * __construct.
     *
     * @param ItemRepository $itemRepository
     * @param ProgramacaoRepository $programacaoRepository
     */
    public function __construct(ItemRepository $itemRepository, ProgramacaoRepository $programacaoRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->itemRepository = $itemRepository;
        $this->programacaoRepository = $programacaoRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $programacao = $this->programacaoRepository->find(\Request::route('id'));
        $view->with('itens', $this->itemRepository->getArrayParaSelect($programacao->planta_id));
    }
}
