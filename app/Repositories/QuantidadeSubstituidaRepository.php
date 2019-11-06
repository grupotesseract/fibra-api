<?php

namespace App\Repositories;

use App\Models\QuantidadeSubstituida;
use App\Repositories\BaseRepository;

/**
 * Class QuantidadeSubstituidaRepository.
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
        'quantidade_substituida',
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
        return QuantidadeSubstituida::class;
    }

    /**
     * Metodo para checar se existe registro para evitar duplicidade.
     *
     * @param mixed $programacaoId
     * @param mixed $materialId
     * @return bool
     */
    public function checaEntradaExistente($itemId, $programacaoId, $materialId)
    {
        return $this->model::where('programacao_id', $programacaoId)
            ->where('material_id', $materialId)
            ->where('item_id', $itemId)
            ->exists();
    }
}
