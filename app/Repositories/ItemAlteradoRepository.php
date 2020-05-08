<?php

namespace App\Repositories;

use App\Models\ItemAlterado;
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
        $itemAlterado->item->materiais()->syncWithoutDetaching(
            [
                $itemAlterado->material_id => [
                    'quantidade_instalada' => $itemAlterado->quantidade_instalada,
                ],
            ]
        );
    }
}
