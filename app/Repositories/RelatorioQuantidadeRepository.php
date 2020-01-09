<?php

namespace App\Repositories;

use App\Models\RelatorioQuantidade;
use App\Repositories\BaseRepository;

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
}
