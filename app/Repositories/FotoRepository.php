<?php

namespace App\Repositories;

use App\Models\Foto;
use App\Repositories\BaseRepository;

/**
 * Class FotoRepository
 * @package App\Repositories
 * @version November 22, 2019, 7:54 pm -03
*/

class FotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id',
        'item_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Foto::class;
    }
}
