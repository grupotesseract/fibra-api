<?php

namespace App\Repositories;

use App\Models\ManutencaoCivilEletrica;
use App\Repositories\BaseRepository;

/**
 * Class ManutencaoCivilEletricaRepository.
 * @version March 20, 2020, 2:54 pm -03
 */
class ManutencaoCivilEletricaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'data_hora_entrada',
        'data_hora_saida',
        'data_hora_inicio_lem',
        'data_hora_final_lem',
        'data_hora_inicio_let',
        'data_hora_final_let',
        'data_hora_inicio_atividades',
        'planta_id',
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
        return ManutencaoCivilEletrica::class;
    }
}
