<?php

namespace App\Repositories;

use App\Models\LiberacaoDocumento;
use App\Repositories\BaseRepository;

/**
 * Class LiberacaoDocumentoRepository
 * @package App\Repositories
 * @version September 25, 2019, 2:34 pm -03
*/

class LiberacaoDocumentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id',
        'data_hora'
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
        return LiberacaoDocumento::class;
    }
}
