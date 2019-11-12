<?php

namespace App\Repositories;

use App\Models\Programacao;
use App\Repositories\BaseRepository;

/**
 * Class ProgramacaoRepository.
 * @version September 13, 2019, 1:48 pm -03
 */
class ProgramacaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'data_inicio_prevista',
        'data_fim_prevista',
        'data_inicio_real',
        'data_fim_real',
        'planta_id',
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
        return Programacao::class;
    }

    /**
     * Método responsável por persistir informações ao banco
     */
    public function sincronizaProgramação($id, $input)
    {
        $programacao = $this->find($id);

        foreach ($input['liberacoesDocumentos'] as $liberacaoDocumento) {
            $liberacaoDocumento = $programacao->liberacoesDocumentos()->create(
                [
                    'data_hora' => $liberacaoDocumento['data_hora']
                ]
            );
            
        }
        
    }
}
