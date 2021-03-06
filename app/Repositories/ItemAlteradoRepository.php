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

        if ($itemAlterado->quantidade_instalada === 0) {
            $itemAlterado->item->materiais()->detach($itemAlterado->material_id);
        } else {
            $itemAlterado->item->materiais()->syncWithoutDetaching(
                [
                    $itemAlterado->material_id => [
                        'quantidade_instalada' => $itemAlterado->quantidade_instalada,
                    ],
                ]
            );
        }

        if ($itemAlterado->material->tipoMaterial && ($itemAlterado->material->tipoMaterial->tipo == 'Lâmpada' || $itemAlterado->material->tipoMaterial->tipo == 'Outros')) {
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
                            'quantidade_substituida_base' => $itemAlterado->quantidade_base,
                            'reator_id' => $itemAlterado->material->reator_id,
                            'quantidade_substituida_reator' => $itemAlterado->quantidade_reator,
                        ]
                    );

                $estoque = $itemAlterado->programacao->estoques()->where('material_id', $itemAlterado->material_id)->get()->first();

                if ($estoque) {
                    $quantidadeEstoqueAtual = $estoque->quantidade_final;
                    $estoque->quantidade_final = $quantidadeEstoqueAtual - $itemAlterado->quantidade_instalada;
                    $estoque->save();
                }

                $estoque = $itemAlterado->programacao->estoques()->where('material_id', $itemAlterado->material->base_id)->get()->first();

                if ($estoque) {
                    $quantidadeEstoqueAtual = $estoque->quantidade_final;
                    $estoque->quantidade_final = $quantidadeEstoqueAtual - $itemAlterado->quantidade_base;
                    $estoque->save();
                }

                $estoque = $itemAlterado->programacao->estoques()->where('material_id', $itemAlterado->material->reator_id)->get()->first();

                if ($estoque) {
                    $quantidadeEstoqueAtual = $estoque->quantidade_final;
                    $estoque->quantidade_final = $quantidadeEstoqueAtual - $itemAlterado->quantidade_reator;
                    $estoque->save();
                }
            }
        }

        $itemAlterado->consolidado = true;
        $itemAlterado->save();
    }
}
