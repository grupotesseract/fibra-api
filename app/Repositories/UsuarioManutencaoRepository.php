<?php

namespace App\Repositories;

use App\Models\UsuarioManutencao;
use App\Repositories\BaseRepository;

/**
 * Class UsuarioManutencaoRepository.
 * @version March 27, 2020, 4:30 pm -03
 */
class UsuarioManutencaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'manutencao_id',
        'usuario_id',
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
        return UsuarioManutencao::class;
    }
}
