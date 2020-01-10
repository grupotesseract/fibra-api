<?php

namespace App\Repositories;

use App\Exports\ProgramacaoExport;
use App\Models\RelatorioQuantidade;
use App\Repositories\BaseRepository;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class RelatorioQuantidadeRepository
 * @package App\Repositories
 * @version January 9, 2020, 7:40 pm -03
*/

class RelatorioQuantidadeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RelatorioQuantidade::class;
    }

    /**
     * Metodo para gerar e salvar o arquivo do relatorio no filesystem
     *
     * @see Maatwebsite\Excel\Excel::store
     * @return boolean | se salvou ou nao
     */
    public function gerarArquivoRelatorio($relatorioQuantidade)
    {
        $programacao = $relatorioQuantidade->programacao;
        return Excel::store(new ProgramacaoExport($programacao), $relatorioQuantidade->pathExcel);
    }

}
