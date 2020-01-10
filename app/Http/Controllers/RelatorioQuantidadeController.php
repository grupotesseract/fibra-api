<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Repositories\ProgramacaoRepository;
use App\Repositories\RelatorioQuantidadeRepository;

class RelatorioQuantidadeController extends AppBaseController
{
    /** @var  RelatorioQuantidadeRepository */
    private $relatorioQuantidadeRepository;
    private $programacaoRepository;

    public function __construct(ProgramacaoRepository $programacaoRepository, RelatorioQuantidadeRepository $relatorioQuantidadeRepo)
    {
        $this->programacaoRepository = $programacaoRepository;
        $this->relatorioQuantidadeRepository = $relatorioQuantidadeRepo;
    }


    /**
     * Metodo para fazer checar se o arquivo do relatorio existe, se existir retorna a URL para download,
     * se não existir dispara o job para geracao do arquivo de forma assíncrona
     *
     * @return JSON - contendo o indice 'downloadURL' se existir o arquivo.
     */
    public function confereExisteRelatorio($id)
    {
        $programacao = $this->programacaoRepository->find($id);
        $relatorio = $programacao->relatorioQuantidade;

        //Se existir e estiver disponivel retornar URL para download
        if ($relatorio && $relatorio->disponivel) {
            return \Response::json([
                'downloadURL' => route('relatorioQuantidade.download', $programacao->id),
            ]);
        }

        //Se nao existir, criar e disparar job
        if (! $relatorio) {
            $relatorio = $this->relatorioQuantidadeRepository->create([
                'programacao_id' => $programacao->id,
            ]);
            \App\Jobs\GerarRelatorioQuantidade::dispatch($relatorio);
        }

        return \Response::json([]);
    }

    /**
     * Metodo para fazer o download de um relatorio fotografico.
     *
     * @return void
     */
    public function downloadRelatorio($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if ($programacao->relatorioQuantidade) {
            return \Response::download($programacao->relatorioQuantidade->pathArquivo);
        }
    }
}
