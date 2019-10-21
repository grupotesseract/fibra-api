<?php

namespace App\Repositories;

use App\Models\QuantidadeMinima;
use App\Repositories\BaseRepository;

/**
 * Class QuantidadeMinimaRepository.
 * @version October 15, 2019, 2:49 pm -03
 */
class QuantidadeMinimaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'material_id',
        'planta_id',
        'quantidade_minima',
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
        return QuantidadeMinima::class;
    }
}
