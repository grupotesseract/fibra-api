<?php

namespace App\Repositories;

use App\Models\Planta;
use App\Repositories\BaseRepository;

/**
 * Class PlantaRepository.
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
        'empresa_id',
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
        return Planta::class;
    }

    /**
     * Retorna um array de Plantas no formato [id => 'nome'].
     *
     * @param mixed $empresaId - Para obter o array de plantas de 1 empresa.
     *
     * @return array
     */
    public function getArrayParaSelect($empresaId = null)
    {
        //Se vier empresaId, filtrar antes do pluck
        if ($empresaId) {
            return $this->model()
                ::where('empresa_id', $empresaId)
                ->pluck('nome', 'id')
                ->all();
        }

        return $this->model()
            ::pluck('nome', 'id')
            ->all();
    }
}