<?php

namespace App\Repositories;

use App\Models\Planta;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class PlantaRepository.
 * @version September 9, 2019, 4:03 pm -03
 */
class PlantaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'endereco',
        'cidade_id',
        'empresa_id',
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
        return Planta::class;
    }

    /**
     * Retorna um array de Plantas no formato [id => 'nome'].
     *
     * @param mixed $empresaId - Para obter o array de plantas de 1 empresa.
     *
     * @return array
     */
    public function getArrayParaSelect($empresaId = null)
    {
        //Se vier empresaId, filtrar antes do pluck
        if ($empresaId) {
            return $this->model()
                ::where('empresa_id', $empresaId)
                ->pluck('nome', 'id')
                ->all();
        }

        return $this->model()
            ::pluck('nome', 'id')
            ->all();
    }

    /**
     * Método responsável por persistir informações de RDO ao banco.
     */
    public function syncRdo($planta, $input)
    {
        Log::info('Input: '.json_encode($input));
        $manutencaoCivilEletrica = null;

        DB::transaction(function () use ($input, $planta, &$manutencaoCivilEletrica) {
            $manutencaoCivilEletrica = $planta->manutencoesCivilEletrica()->create($input['manutencao_civil_eletrica']);
            $manutencaoCivilEletrica->atividadesRealizadas()->createMany($input['atividades_realizadas']);
        });

        return $manutencaoCivilEletrica;
    }
}
