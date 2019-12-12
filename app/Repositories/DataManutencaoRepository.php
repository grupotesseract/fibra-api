<?php

namespace App\Repositories;

use App\Models\DataManutencao;
use App\Repositories\BaseRepository;

/**
 * Class DataManutencaoRepository
 * @package App\Repositories
 * @version December 12, 2019, 3:50 pm -03
*/

class DataManutencaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id',
        'item_id',
        'data_inicio',
        'data_fim'
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
        return DataManutencao::class;
    }
}
