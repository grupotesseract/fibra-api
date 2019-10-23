<?php

namespace App\Repositories;

use App\Models\Estoque;
use App\Repositories\BaseRepository;

/**
 * Class EstoqueRepository
 * @package App\Repositories
 * @version October 23, 2019, 7:50 pm -03
*/

class EstoqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'material_id',
        'programacao_id',
        'quantidade_inicial',
        'quantidade_final'
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
        return Estoque::class;
    }
}
