<?php

namespace App\Repositories;

use App\Models\Tensao;
use App\Repositories\BaseRepository;

/**
 * Class TensaoRepository.
 * @version September 18, 2019, 4:52 pm -03
 */
class TensaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'valor',
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
        return Tensao::class;
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
