<?php

namespace App\Http\Controllers;

use Response;
use App\Http\Requests;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProgramacaoRepository;
use App\Repositories\RelatorioFotograficoRepository;

class RelatorioFotograficoController extends AppBaseController
{

    public $relatorioFotograficoRepository;
    public $programacaoRepository;

    /**
     * @param ProgramacaoRepository $programacaoRepository
     */
    public function __construct(ProgramacaoRepository $programacaoRepository, RelatorioFotograficoRepository $relatorioFotograficoRepository)
    {
        $this->programacaoRepository = $programacaoRepository;
        $this->relatorioFotograficoRepository = $relatorioFotograficoRepository;
    }

    /**
     * Metodo para fazer download do relatório de fotos de uma programacao.
     *
     * @return download
     */
    public function confereRelatorioFotos($id)
    {
        $programacao = $this->programacaoRepository->find($id);
        $relatorio = $programacao->relatorioFotografico;

        //Se existir e estiver disponivel retornar URL para download
        if ($relatorio && $relatorio->disponivel) {
            return \Response::json([
                'downloadURL' => route('relatorioFotografico.download', $programacao->id)
            ]);
        }

        //Se nao existir, criar e disparar job
        if (!$relatorio) {
            $relatorio = $this->relatorioFotograficoRepository->create([
                'programacao_id' => $programacao->id
            ]);
            \App\Jobs\GerarRelatorioFotografico::dispatch($relatorio);
        }

        return \Response::json([]);
    }

    /**
     * Metodo para fazer o download de um relatorio fotografico
     *
     * @return void
     */
    public function downloadRelatorioFotos($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if ($programacao->relatorioFotografico) {
            return \Response::download($programacao->relatorioFotografico->pathArquivo);
        }
    }
}
