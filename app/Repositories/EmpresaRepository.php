<?php

namespace App\Repositories;

use App\Models\Empresa;
use App\Repositories\BaseRepository;

/**
 * Class EmpresaRepository.
 * @version September 3, 2019, 4:23 pm -03
 */
class EmpresaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'email',
        'telefone',
        'endereco',
        'cidade_id',
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
        return Empresa::class;
    }

    /**
     * Retorna um array de Empresas no formato [id => 'nome'].
     *
     * @return array
     */
    public function getArrayParaSelect()
    {
        return $this->model()::pluck('nome', 'id')->all();
    }
}
