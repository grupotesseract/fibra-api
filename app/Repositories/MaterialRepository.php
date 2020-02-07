<?php

namespace App\Repositories;

use App\Models\Material;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class MaterialRepository.
 * @version September 10, 2019, 4:11 pm -03
 */
class MaterialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'potencia',
        'tensao',
        'tipo_material_id',
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
        return Material::class;
    }

    /**
     * Retorna um array de  Materiais no formato [id => 'nome'].
     *
     * @return array
     */
    public function getArrayParaSelect()
    {
        return $this->model()::pluck('nome', 'id')->all();
    }

    /**
     * Retorna um array de Materiais no formato [id => 'Nome - Potencia W - Tensao V'].
     *
     * @return array
     */
    public function getArrayNomePotenciaTensaoParaSelect($tipoMaterialTipo = null)
    {
        if (! is_null($tipoMaterialTipo)) {
            $materiais = $this->model()::whereHas(
                'tipoMaterial', function (Builder $query) use ($tipoMaterialTipo) {
                    $query->where('tipo', $tipoMaterialTipo)->orderBy('tipo')->orderBy('nome');
                }
            )->orderBy('nome')->get()->pluck('nomePotenciaTensao', 'id')->all();
        } else {
            $materiais = $this->model()::doesntHave('tipoMaterial')->orderBy('nome')->get()->pluck('nomePotenciaTensao', 'id')->all();
        }

        return $materiais;
    }

    /**
     * Retorna um array com todos os Materiais.
     *
     * @return array
     */
    public function getArrayTodosMateriais()
    {
        return $this->model()::with(['potencia', 'tensao', 'tipoMaterial', 'reator', 'base'])->orderBy('nome')->get()->pluck('nomePotenciaTensao', 'id')->toArray();
    }
}
