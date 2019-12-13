<?php

namespace App\Repositories;

use App\Models\ComentarioGeral;
use App\Repositories\BaseRepository;

/**
 * Class ComentarioGeralRepository.
 * @version December 11, 2019, 9:03 pm -03
 */
class ComentarioGeralRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return ComentarioGeral::class;
    }
}
