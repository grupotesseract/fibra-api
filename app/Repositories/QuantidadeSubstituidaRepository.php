<?php

namespace App\Repositories;

use App\Models\QuantidadeSubstituida;
use App\Repositories\BaseRepository;

/**
 * Class QuantidadeSubstituidaRepository
 * @package App\Repositories
 * @version October 23, 2019, 3:09 pm -03
*/

class QuantidadeSubstituidaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id',
        'item_id',
        'material_id',
        'quantidade_substituida'
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
        return QuantidadeSubstituida::class;
    }
}
