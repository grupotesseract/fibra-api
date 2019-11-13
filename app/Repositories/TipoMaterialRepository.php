<?php

namespace App\Repositories;

use App\Models\TipoMaterial;
use App\Repositories\BaseRepository;

/**
 * Class TipoMaterialRepository.
 * @version September 4, 2019, 3:51 pm -03
 */
class TipoMaterialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
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
        return TipoMaterial::class;
    }

    /**
     * Retorna um array de Tipos de Materiais no formato [id => 'nome'].
     *
     * @return array
     */
    public function getArrayParaSelect()
    {
        return $this->model()::all()->pluck('nomeSelect', 'id')->all();
    }
}
