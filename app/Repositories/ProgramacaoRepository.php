<?php

namespace App\Repositories;

use App\Models\Material;
use App\Models\Programacao;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        Log::info('Input: '.json_encode($input));

        DB::transaction(function () use ($input, $programacao) {

            //DADOS DA PROGRAMAÇÃO
            $programacao->update($input['programacao']);

            //COMENTÁRIOS DE UM ITEM
            $programacao->comentarios()->createMany($input['comentarios']);

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

            //ITENS ALTERADOS
            $programacao->itensAlterados()->createMany($input['itensAlterados']);

            //DATAS DAS MANUTENÇÕES

            foreach ($input['datasManutencoes'] as $dataManutencao) {
                if (array_key_exists('data_fim', $dataManutencao)) {
                    $programacao->datasManutencoes()->create($dataManutencao);
                }
            }

            //COMENTÁRIOS GERAIS
            if (array_key_exists('comentarioGeral', $input['programacao'])) {
                $programacao->comentariosGerais()->create(
                    [
                        'comentario' => $input['programacao']['comentarioGeral'],
                    ]
                );
            }

            //ATUALIZANDO INFORMAÇÕES DE ESTOQUE
            //ITERANDO POR CADA MATERIAL DO OBJETO DE ESTOQUE PRA CALCULO DO ESTOQUE FINAL
            foreach ($input['estoques'] as $key => $estoque) {
                $material = Material::find($estoque['material_id']);
                $entradaMaterial = $programacao->entradasMateriais()->where('material_id', $estoque['material_id'])->get()->first();
                $qtdadeEntradaMaterial = ! is_null($entradaMaterial) ? $entradaMaterial->quantidade : 0;

                if (! is_null($material->tipoMaterial)) {
                    if ($material->tipoMaterial->tipo == 'Lâmpada') {
                        $qtdeSubstituidaMaterial = $programacao->quantidadesSubstituidas()->where('material_id', $estoque['material_id'])->sum('quantidade_substituida');
                    } elseif ($material->tipoMaterial->tipo == 'Reator') {
                        $qtdeSubstituidaMaterial = $programacao->quantidadesSubstituidas()->where('reator_id', $estoque['material_id'])->sum('quantidade_substituida_reator');
                    }
                } else {
                    $qtdeSubstituidaMaterial = $programacao->quantidadesSubstituidas()->where('base_id', $estoque['material_id'])->sum('quantidade_substituida_base');
                }

                ///ESTOQUE FINAL + ENTRADA - SUBSTITUIÇÃO
                $qtdadeEstoqueFinalMaterial = $estoque['quantidade_inicial'] + $qtdadeEntradaMaterial - $qtdeSubstituidaMaterial;
                $input['estoques'][$key]['quantidade_final'] = $qtdadeEstoqueFinalMaterial;
            }

            //PERSISTINDO ESTOQUE CALCULADO
            $programacao->estoques()->createMany($input['estoques']);
        });
    }
}
