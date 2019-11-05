<?php

namespace App\Repositories;

use App\Models\EntradaMaterial;
use App\Repositories\BaseRepository;

/**
 * Class EntradaMaterialRepository.
 * @version October 29, 2019, 12:14 am -03
 */
class EntradaMaterialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'material_id',
        'programacao_id',
        'quantidade',
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
        return EntradaMaterial::class;
    }

    /**
     * Metodo para checar se existe registro para evitar duplicidade.
     *
     * @param mixed $programacaoId
     * @param mixed $materialId
     * @return bool
     */
    public function checaEntradaExistente($programacaoId, $materialId)
    {
        return $this->model::where('programacao_id', $programacaoId)
            ->where('material_id', $materialId)
            ->exists();
    }
}
