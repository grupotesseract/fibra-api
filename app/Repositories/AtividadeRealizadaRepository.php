<?php

namespace App\Repositories;

use App\Models\AtividadeRealizada;
use App\Repositories\BaseRepository;

/**
 * Class AtividadeRealizadaRepository
 * @package App\Repositories
 * @version March 27, 2020, 3:31 pm -03
*/

class AtividadeRealizadaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'texto',
        'status',
        'manutencao_id'
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
        return AtividadeRealizada::class;
    }
}
