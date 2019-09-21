<?php

namespace App\Repositories;

use App\Models\Potencia;
use App\Repositories\BaseRepository;

/**
 * Class PotenciaRepository
 * @package App\Repositories
 * @version September 18, 2019, 3:48 pm -03
*/

class PotenciaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'valor'
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
        return Potencia::class;
    }

    /**
     * Retorna um array de Potências no formato [id => 'valor'].
     *
     * @return array
     */
    public function getArrayParaSelect()
    {
        return $this->model()::pluck('valor', 'id')->all();
    }
}
