<?php

namespace App\Repositories;

use App\Models\RelatorioFotografico;
use App\Repositories\BaseRepository;

/**
 * Class RelatorioFotograficoRepository
 * @package App\Repositories
 * @version December 30, 2019, 10:12 pm -03
*/

class RelatorioFotograficoRepository extends BaseRepository
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
        return RelatorioFotografico::class;
    }


    /**
     * Metodo para gerar o relatório de fotos da programação.
     *
     * @return void
     */
    public function gerarRelatorioFotos($programacao)
    {
        $idsItemsComFoto = $programacao->fotos()->pluck('item_id')->unique();
        $itens = $programacao->planta->itens->whereIn('id', $idsItemsComFoto);

        $phpWord = \App\Helpers\PhpWordHelper::criarDoc();
        $section = \App\Helpers\PhpWordHelper::addContainerSecoes($phpWord);
        $indice = 1;

        foreach ($itens as $item) {
            $fotos = $programacao->fotos->where('item_id', $item->id);
            \App\Helpers\PhpWordHelper::addSecaoTitulo($section, $indice++, $item->nome);
            \App\Helpers\PhpWordHelper::addSecaoFotos($section, $fotos);
        }

        return \App\Helpers\PhpWordHelper::salvarDoc($phpWord);
    }
}
