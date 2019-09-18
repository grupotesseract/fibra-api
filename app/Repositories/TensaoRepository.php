<?php

namespace App\Repositories;

use App\Models\Tensao;
use App\Repositories\BaseRepository;

/**
 * Class TensaoRepository
 * @package App\Repositories
 * @version September 18, 2019, 4:52 pm -03
*/

class TensaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'valor'
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
        return Tensao::class;
    }
}
