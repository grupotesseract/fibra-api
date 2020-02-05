<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Repositories\ProgramacaoRepository;
use App\Repositories\RelatorioFotograficoRepository;
use Response;
use Flash;

class RelatorioFotograficoController extends AppBaseController
{
    /** @var RelatorioFotograficoRepository */
    public $relatorioFotograficoRepository;

    /** @var ProgramacaoRepository */
    public $programacaoRepository;

    /**
     * __construct.
     *
     * @param ProgramacaoRepository $programacaoRepository
     * @param RelatorioFotograficoRepository $relatorioFotograficoRepository
     */
    public function __construct(ProgramacaoRepository $programacaoRepository, RelatorioFotograficoRepository $relatorioFotograficoRepository)
    {
        $this->programacaoRepository = $programacaoRepository;
        $this->relatorioFotograficoRepository = $relatorioFotograficoRepository;
    }

    /**
     * Metodo para checar se o arquivo do relatorio existe, se existir retorna a URL para download
     * Se não existir dispara o job para geracao do arquivo de forma assíncrona.
     *
     * @return JSON - contendo o indice 'downloadURL' se existir o arquivo.
     */
    public function confereRelatorioFotos($id)
    {
        $programacao = $this->programacaoRepository->find($id);
        $relatorio = $programacao->relatorioFotografico;

        //Se existir e estiver disponivel retornar URL para download
        if ($relatorio && $relatorio->disponivel) {
            return \Response::json([
                'downloadURL' => route('relatorioFotografico.download', $programacao->id),
            ]);
        }

        //Se nao existir, criar e disparar job
        if (! $relatorio) {
            $relatorio = $this->relatorioFotograficoRepository->create([
                'programacao_id' => $programacao->id,
            ]);
            \App\Jobs\GerarRelatorioFotografico::dispatch($relatorio);
        }

        return \Response::json([]);
    }

    /**
     * Metodo para fazer o download do arquivo do relatorio.
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

    public function deleteRelatorioFotos($id)
    {
        $programacao = $this->programacaoRepository->find($id);
        $programacao->relatorioFotografico()->delete();        

        Flash::success('Relatório excluído com sucesso');
        return view('programacoes.show')->with('programacao', $programacao);
    }
}
