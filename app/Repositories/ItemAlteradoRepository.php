<?php

namespace App\Repositories;

use App\Models\ItemAlterado;
use App\Models\QuantidadeSubstituida;
use App\Repositories\BaseRepository;

/**
 * Class ItemAlteradoRepository.
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
        'quantidade_instalada',
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
        return ItemAlterado::class;
    }

    /**
     * Método para consolidar item a partir de um item alterado.
     *
     * @param ItemAlterado $itemAlterado
     * @return void
     */
    public function consolida($itemAlterado)
    {
        /*
            pega registro atual
            faz o sync
            insere quantidade substituida
            subtrai quantidade substituida do estoque
        */

        $itemAlterado->item->materiais()->syncWithoutDetaching(
            [
                $itemAlterado->material_id => [
                    'quantidade_instalada' => $itemAlterado->quantidade_instalada,
                ],
            ]
        );

        if ($itemAlterado->material->tipoMaterial->tipo == 'Lâmpada') {
            $quantidadeSubstituida = $itemAlterado->programacao->quantidadesSubstituidas()
                ->where('item_id', $itemAlterado->item_id)
                ->where('material_id', $itemAlterado->material_id)
                ->where('base_id', $itemAlterado->material->base_id)
                ->where('reator_id', $itemAlterado->material->reator_id)
                ->get()
                ->first();

            if (! $quantidadeSubstituida) {
                $itemAlterado->programacao->quantidadesSubstituidas()
                    ->create(
                        [
                            'item_id' => $itemAlterado->item_id,
                            'material_id' => $itemAlterado->material_id,
                            'quantidade_substituida' => $itemAlterado->quantidade_instalada,
                            'base_id' => $itemAlterado->material->base_id,
                            //'quantidade_substituida_base' => 1,
                            'reator_id' => $itemAlterado->material->reator_id,
                            //'quantidade_substituida_reator' => 1,
                        ]
                    );

                $estoque = $itemAlterado->programacao->estoques()->where('material_id', $itemAlterado->material_id)->get()->first();

                if ($estoque) {
                    $quantidadeEstoqueAtual = $estoque->quantidade_final;
                    $estoque->quantidade_final = $quantidadeEstoqueAtual - $itemAlterado->quantidade_instalada;
                    $estoque->save();
                }
            }

            //ATUALIZAR/CRIAR REGISTRO DO ESTOQUE PARA MATERIAL,BASE E REATOR - QUANTIDADE ATUAL ESTOQUE - QUANTIDADE SUBSTITUIDA
        }
    }
}
