<?php

namespace App\Repositories;

use App\Models\ItemAlterado;
use App\Repositories\BaseRepository;

/**
 * Class ItemAlteradoRepository
 * @package App\Repositories
 * @version April 24, 2020, 3:13 pm -03
*/

class ItemAlteradoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id',
        'item_id',
        'material_id',
        'quantidade_instalada'
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
        return ItemAlterado::class;
    }
}
