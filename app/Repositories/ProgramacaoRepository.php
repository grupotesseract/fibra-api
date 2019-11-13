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
     * Método responsável por persistir informações ao banco.
     */
    public function sincronizaProgramação($programacao, $input)
    {
        //LIBERAÇÕES DE DOCUMENTOS
        foreach ($input['liberacoesDocumentos'] as $inputLiberacaoDocumento) {
            $liberacaoDocumento = $programacao->liberacoesDocumentos()->create(
                [
                    'data_hora' => $inputLiberacaoDocumento['data_hora'],
                ]
            );

            //SYNC DOS COLABORADORES ASSOCIADOS A LIBERAÇÃO DO DOCUMENTO
            $liberacaoDocumento->usuarios()->sync($inputLiberacaoDocumento['usuarios']);
        }

        //ENTRADAS DE MATERIAIS
        $programacao->entradasMateriais()->createMany($input['entradas']);

        //QUANTIDADES SUBSTITUIDAS
        $programacao->quantidadesSubstituidas()->createMany($input['quantidadesSubstituidas']);

        //ATUALIZANDO INFORMAÇÕES DE ESTOQUE
        //ITERANDO POR CADA MATERIAL DO OBJETO DE ESTOQUE PRA CALCULO DO ESTOQUE FINAL
        foreach ($input['estoques'] as $key => $estoque) {
            $qtdadeEntradaMaterial = $programacao->entradasMateriais()->where('material_id', $estoque['material_id'])->get()->first()->quantidade;
            $qtdeSubstituidaMaterial = $programacao->quantidadesSubstituidas()->where('material_id', $estoque['material_id'])->sum('quantidade_substituida');

            //ESTOQUE FINAL + ENTRADA - SUBSTITUIÇÃO
            $qtdadeEstoqueFinalMaterial = $estoque['quantidade_inicial'] + $qtdadeEntradaMaterial - $qtdeSubstituidaMaterial;
            $input['estoques'][$key]['quantidade_final'] = $qtdadeEstoqueFinalMaterial;
        }

        //PERSISTINDO ESTOQUE CALCULADO
        $programacao->estoques()->createMany($input['estoques']);
    }
}
