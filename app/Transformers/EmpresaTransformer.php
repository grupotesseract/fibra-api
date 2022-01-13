<?php

namespace App\Transformers;

use App\Models\Empresa;
use App\Models\Material;
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
            $itenBD = $planta->itens->sortBy('qrcode')->all();
            foreach ($itenBD as $item) {
                //Materiais Instalados de uma Planta
                // $materiaisArray = $item->materiais()->whereHas(
                //     'tipoMaterial', function ($query) {
                //         $query->whereIn('tipo', ['Lâmpada', 'Outros']);
                //     }
                // )->get();
                $materiaisArray = $item->materiais;
                $materiais = [];
                $todosMateriais = [];

                foreach ($materiaisArray as $material) {
                    if (!is_null($material->tipoMaterial)) {
                        if (in_array($material->tipoMaterial->tipo, ['Lâmpada', 'Outros'])) {
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
                    }

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

                // $todosMateriaisArray = $item->materiais()->get();
                // $todosMateriais = [];

                // foreach ($todosMateriaisArray as $material) {
                //     $todosMateriais[] = [
                //         'id' => $material->id,
                //         'nome' => $material->nome,
                //         'base' => $material->baseNome,
                //         'reator' => $material->reatorNome,
                //         'base_id' => $material->base_id,
                //         'reator_id' => $material->reator_id,
                //         'potencia' => $material->potenciaValor,
                //         'tensao' => $material->tensaoValor,
                //         'tipoMaterial' => $material->tipoMaterialNome,
                //         'tipoMaterialTipo' => $material->tipoMaterial ? $material->tipoMaterial->tipo : null,
                //         'quantidadeInstalada' => $material->pivot->quantidade_instalada,
                //     ];
                // }

                $itens[] = [
                    'id' => $item->id,
                    'nome' => $item->nome,
                    'qrcode' => $item->qrcode,
                    'circuito' => $item->circuito,
                    'materiais' => $materiais ?? null,
                    'todosMateriais' => $todosMateriais ?? null,
                ];

                $itensId[] = $item->id;
            }

            //Informações de Estoque obtidas através da Programação Anterior mais Recente e itens materiais instalados
            $estoquePlanta = [];
            $entradaMateriais = [];

            if (isset($itensId)) {
                $materiaisId = \DB::table('itens_materiais')->whereIn('item_id', $itensId)->pluck('material_id');
                $materiaisParaEstoque = Material::whereIn('id', $materiaisId)->get();

                if (! is_null($planta->programacaoAnteriorMaisRecente)) {
                    $estoquesProgramacao = $planta->programacaoAnteriorMaisRecente->estoques;
                }

                foreach ($materiaisParaEstoque as $materialParaEstoque) {
                    $estoquePlanta[] = [
                        'id' => $materialParaEstoque->id,
                        'nome' => $materialParaEstoque->nome,
                        'base' => $materialParaEstoque->baseNome,
                        'reator' => $materialParaEstoque->reatorNome,
                        'potencia' => $materialParaEstoque->potenciaValor,
                        'tensao' => $materialParaEstoque->tensaoValor,
                        'tipoMaterial' => $materialParaEstoque->tipoMaterialNome,
                        'tipoMaterialTipo' => $materialParaEstoque->tipoMaterial ? $materialParaEstoque->tipoMaterial->tipo : null,
                        'tipoMaterialAbreviacao' => $materialParaEstoque->tipoMaterial ? $materialParaEstoque->tipoMaterial->abreviacao : null,
                        'quantidade' => $estoquesProgramacao->where('material_id', $materialParaEstoque->id)->first()->quantidade_final ?? 0,
                    ];

                    $entradaMateriais[] = [
                        'id' => $materialParaEstoque->id,
                        'nome' => $materialParaEstoque->nome,
                        'base' => $materialParaEstoque->baseNome,
                        'reator' => $materialParaEstoque->reatorNome,
                        'potencia' => $materialParaEstoque->potenciaValor,
                        'tensao' => $materialParaEstoque->tensaoValor,
                        'tipoMaterial' => $materialParaEstoque->tipoMaterialNome,
                        'tipoMaterialTipo' => $materialParaEstoque->tipoMaterial ? $materialParaEstoque->tipoMaterial->tipo : null,
                    ];
                }
            }

            //RETORNANDO ATIVIDADES REALIZADAS PENDENTES
            $atividadesPendentesDB = $planta->atividadesRealizadas->where('status', false)->unique('texto');
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
