<?php

namespace App\Repositories;

use App\Models\Planta;
use App\Repositories\BaseRepository;

/**
 * Class PlantaRepository
 * @package App\Repositories
 * @version September 9, 2019, 4:03 pm -03
*/

class PlantaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'endereco',
        'cidade_id',
        'empresa_id'
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
        return Planta::class;
    }
}
