<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\BaseRepository;

/**
 * Class ItemRepository.
 * @version September 12, 2019, 4:33 pm -03
 */
class ItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'qrcode',
        'circuito',
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
        return Item::class;
    }

    /**
     * Retorna um array de Itens no formato [id => 'nome'].
     *
     * @param mixed $plantaId - caso queira somente os itens de uma planta especifica
     * @return array
     */
    public function getArrayParaSelect($plantaId = null)
    {
        if ($plantaId) {
            return $this->model()::where('planta_id', $plantaId)
                ->get()->pluck('qrCodeNome', 'id')->all();
        }

        return $this->model()::get()->pluck('qrCodeNome', 'id')->all();
    }

    /**
     * Metodo para fazer update da quantidade instalada de um material em um item.
     *
     * @return void
     */
    public function updateQuantidadeInstaladaMaterial($item, $idMaterial, $qntInstalada)
    {
        return $item->materiais()->updateExistingPivot($idMaterial, [
            'quantidade_instalada' => $qntInstalada,
        ]);
    }
}
