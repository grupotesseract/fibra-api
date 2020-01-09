<?php

namespace App\Http\Controllers;

use App\Repositories\RelatorioQuantidadeRepository;
use App\Http\Controllers\AppBaseController;

class RelatorioQuantidadeController extends AppBaseController
{
    /** @var  RelatorioQuantidadeRepository */
    private $relatorioQuantidadeRepository;

    public function __construct(RelatorioQuantidadeRepository $relatorioQuantidadeRepo)
    {
        $this->relatorioQuantidadeRepository = $relatorioQuantidadeRepo;
    }
}
