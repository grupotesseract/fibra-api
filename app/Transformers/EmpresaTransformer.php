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
            $itens = [];
            foreach ($planta->itens()->orderBy('qrcode')->get() as $item) {

                //Materiais Instalados de uma Planta
                $materiais = [];
                $materiaisArray = $item->materiais()->whereHas(
                    'tipoMaterial', function ($query) {
                        $query->whereIn('tipo', ['Lâmpada', 'Outros']);
                    }
                )->get();

                foreach ($materiaisArray as $material) {
                    $materiais[] = [
                        'id' => $material->id,
                        'nome' => $material->nome,
                        'base' => $material->baseNome,
                        'reator' => $material->reatorNome,
                        'base_id' => $material->base_id,
                        'reator_id' => $material->reator_id,
                        'potencia' => $material->potenciaValor,
                        'tensao' => $material->tensaoValor,
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
            $entradaMateriais = [];
            if (! is_null($planta->programacaoAnteriorMaisRecente)) {
                foreach ($planta->programacaoAnteriorMaisRecente->estoques as $estoque) {
                    if (! is_null($estoque->material)) {
                        $estoquePlanta[] = [
                            'id' => $estoque->material_id,
                            'nome' => $estoque->material->nome,
                            'base' => $estoque->material->baseNome,
                            'reator' => $estoque->material->reatorNome,
                            'potencia' => $estoque->material->potenciaValor,
                            'tensao' => $estoque->material->tensaoValor,
                            'tipoMaterial' => $estoque->material->tipoMaterialNome,
                            'tipoMaterialTipo' => $estoque->material->tipoMaterial ? $estoque->material->tipoMaterial->tipo : null,
                            'quantidade' => $estoque->quantidade_final,
                        ];

                        $entradaMateriais[] = [
                            'id' => $estoque->material_id,
                            'nome' => $estoque->material->nome,
                            'base' => $estoque->material->baseNome,
                            'reator' => $estoque->material->reatorNome,
                            'potencia' => $estoque->material->potenciaValor,
                            'tensao' => $estoque->material->tensaoValor,
                            'tipoMaterial' => $estoque->material->tipoMaterialNome,
                            'tipoMaterialTipo' => $estoque->material->tipoMaterial ? $estoque->material->tipoMaterial->tipo : null,
                        ];
                    }
                }
            }

            $plantas[] = [
                'id' => $planta->id,
                'nome' => $planta->nome,
                'proximaProgramacao' => $proximaProgramacao,
                'itens' => $itens ?? null,
                'estoque' => $estoquePlanta,
                'entrada' => $entradaMateriais,
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
