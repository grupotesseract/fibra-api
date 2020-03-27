<?php

namespace App\Repositories;

use App\Models\RelatorioQuantidade;
use App\Repositories\BaseRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QtdesExport;

/**
 * Class RelatorioQuantidadeRepository.
 * @version January 9, 2020, 7:40 pm -03
 */
class RelatorioQuantidadeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return RelatorioQuantidade::class;
    }

    /**
     * Metodo para gerar e salvar o arquivo do relatorio no filesystem.
     *
     * @see Maatwebsite\Excel\Excel::store
     * @return bool | se salvou ou nao
     */
    public function gerarArquivoRelatorio($relatorioQuantidade)
    {
        $Qtdes = $this->app->make('App\Exports\ProgramacaoExport', ['programacao' => $relatorioQuantidade->programacao]);
        return Excel::store($Qtdes, $relatorioQuantidade->pathExcel);
    }
}
