<?php

namespace App\Repositories;

use App\Models\Material;
use App\Repositories\BaseRepository;

/**
 * Class MaterialRepository.
 * @version September 10, 2019, 4:11 pm -03
 */
class MaterialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'potencia',
        'tensao',
        'tipo_material_id',
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
        return Material::class;
    }

    /**
     * Retorna um array de Tipos de Materiais no formato [id => 'nome'].
     *
     * @return array
     */
    public function getArrayParaSelect()
    {
        return $this->model()::pluck('nome', 'id')->all();
    }
}
