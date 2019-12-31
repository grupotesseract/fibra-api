<?php

namespace App\Http\Controllers;

use Response;
use App\Http\Requests;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProgramacaoRepository;

class RelatorioFotograficoController extends AppBaseController
{

    /**
     * @param ProgramacaoRepository $programacaoRepository
     */
    public function __construct(ProgramacaoRepository $programacaoRepository)
    {
        $this->programacaoRepository = $programacaoRepository;
    }

    /**
     * Metodo para fazer download do relatório de fotos de uma programacao.
     *
     * @return download
     */
    public function downloadRelatorioFotos($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if ($programacao->relatorioFotos) {
            return \Response::download($programacao->relatorioFotos->pathArquivo);
        }

        else {
            \App\Jobs\GerarRelatorioFotografico::dispatch($programacao);
        }

        return \Response::json(['success' => true])
    }
}
