<?php

namespace App\Transformers;

use App\Models\Empresa;
use League\Fractal\TransformerAbstract;

class EmpresaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Empresa $empresa)
    {
        foreach ($empresa->plantas as $planta) {

            //Programação mais Recente
            $proximaProgramacao = ! is_null($planta->proximaProgramacao) ? [
                'id' => $planta->proximaProgramacao->id,
                'data_inicio_prevista' => $planta->proximaProgramacao->data_inicio_prevista,
                'data_fim_prevista' => $planta->proximaProgramacao->data_fim_prevista,
            ] : null;

            //Itens de uma Planta
            foreach ($planta->itens as $item) {

                //Materiais Instalados de uma Planta
                $materiais = [];
                foreach ($item->materiais as $material) {
                    $materiais[] = [
                        'id' => $material->id,
                        'nome' => $material->nome,
                        'base' => $material->baseNome,
                        'reator' => $material->reatorNome,
                        'tipoMaterial' => $material->tipoMaterialNome,
                        'quantidadeInstalada' => $material->pivot->quantidade_instalada,
                    ];
                }

                $itens[] = [
                    'id' => $item->id,
                    'nome' => $item->nome,
                    'qrcode' => $item->qrcode,
                    'circuito' => $item->circuito,
                    'materiais' => $materiais ?? null,
                ];
            }

            //Informações de Estoque obtidas através da Programação Anterior mais Recente
            $estoquePlanta = [];
            if (! is_null($planta->programacaoAnteriorMaisRecente)) {
                foreach ($planta->programacaoAnteriorMaisRecente->estoques as $estoque) {
                    $estoquePlanta[] = [
                        'id' => $estoque->material_id,
                        'nome' => $estoque->material->nome,
                        'base' => $estoque->material->baseNome,
                        'reator' => $estoque->material->reatorNome,
                        'tipoMaterial' => $estoque->material->tipoMaterialNome,
                        'quantidade' => $estoque->quantidade_final,
                    ];
                }
            }

            $plantas[] = [
                'id' => $planta->id,
                'nome' => $planta->nome,
                'proximaProgramacao' => $proximaProgramacao,
                'itens' => $itens ?? null,
                'estoque' => $estoquePlanta,
            ];
        }

        //Montagem final da Resposta da API
        return [
            'id' => $empresa->id,
            'nome' => $empresa->nome,
            'plantas' => $plantas ?? null,
        ];
    }
}