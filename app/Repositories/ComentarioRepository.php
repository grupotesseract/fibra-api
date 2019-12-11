<?php

namespace App\Repositories;

use App\Models\Comentario;
use App\Repositories\BaseRepository;

/**
 * Class ComentarioRepository.
 * @version December 10, 2019, 12:27 am -03
 */
class ComentarioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'item_id',
        'programacao_id',
        'comentario',
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
        return Comentario::class;
    }
}
