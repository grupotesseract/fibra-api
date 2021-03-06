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
        $plantasDB = $empresa->plantas;

        foreach ($plantasDB as $planta) {

            //Programação mais Recente
            $proximaProgramacao = ! is_null($planta->proximaProgramacao) ? [
                'id' => $planta->proximaProgramacao->id,
                'data_inicio_prevista' => $planta->proximaProgramacao->data_inicio_prevista,
                'data_fim_prevista' => $planta->proximaProgramacao->data_fim_prevista,
            ] : null;

            //Itens de uma Planta
            $itens = [];
            $itenBD = $planta->itens()->orderBy('qrcode')->get();
            foreach ($itenBD as $item) {

                //Materiais Instalados de uma Planta
                $materiaisArray = $item->materiais()->whereHas(
                    'tipoMaterial', function ($query) {
                        $query->whereIn('tipo', ['Lâmpada', 'Outros']);
                    }
                )->get();
                $materiais = [];

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

                $todosMateriaisArray = $item->materiais()->get();
                $todosMateriais = [];

                foreach ($todosMateriaisArray as $material) {
                    $todosMateriais[] = [
                        'id' => $material->id,
                        'nome' => $material->nome,
                        'base' => $material->baseNome,
                        'reator' => $material->reatorNome,
                        'base_id' => $material->base_id,
                        'reator_id' => $material->reator_id,
                        'potencia' => $material->potenciaValor,
                        'tensao' => $material->tensaoValor,
                        'tipoMaterial' => $material->tipoMaterialNome,
                        'tipoMaterialTipo' => $material->tipoMaterial ? $material->tipoMaterial->tipo : null,
                        'quantidadeInstalada' => $material->pivot->quantidade_instalada,
                    ];
                }

                $itens[] = [
                    'id' => $item->id,
                    'nome' => $item->nome,
                    'qrcode' => $item->qrcode,
                    'circuito' => $item->circuito,
                    'materiais' => $materiais ?? null,
                    'todosMateriais' => $todosMateriais ?? null,
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
                            'tipoMaterialAbreviacao' => $estoque->material->tipoMaterial ? $estoque->material->tipoMaterial->abreviacao : null,
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

            //RETORNANDO ATIVIDADES REALIZADAS PENDENTES
            $atividadesPendentesDB = $planta->atividadesRealizadas()->whereStatus(false)->get();
            $atividadesPendentes = [];

            foreach ($atividadesPendentesDB as $atividadePendentesDB) {
                $atividadesPendentes[] = [
                    'id' => $atividadePendentesDB->id,
                    'texto' => $atividadePendentesDB->texto,
                ];
            }

            $plantas[] = [
                'id' => $planta->id,
                'nome' => $planta->nome,
                'proximaProgramacao' => $proximaProgramacao,
                'itens' => $itens ?? null,
                'estoque' => $estoquePlanta,
                'entrada' => $entradaMateriais,
                'atividadesPendentes' => $atividadesPendentes,
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
