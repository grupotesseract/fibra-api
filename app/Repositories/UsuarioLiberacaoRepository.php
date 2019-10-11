<?php

namespace App\Repositories;

use App\Models\UsuarioLiberacao;
use App\Repositories\BaseRepository;

/**
 * Class UsuarioLiberacaoRepository
 * @package App\Repositories
 * @version October 11, 2019, 4:39 pm -03
*/

class UsuarioLiberacaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'liberacao_documento_id',
        'usuario_id'
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
        return UsuarioLiberacao::class;
    }
}
