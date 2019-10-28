<?php

namespace App\Transformers;

use App\Models\Planta;
use League\Fractal\TransformerAbstract;

class PlantaTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Planta $planta)
    {
        $programacaoMaisRecente = !is_null($planta->programacaoMaisRecente) ? [
            'data_inicio_prevista' => $planta->programacaoMaisRecente->data_inicio_prevista,
            'data_fim_prevista' => $planta->programacaoMaisRecente->data_fim_prevista,
        ] : null;
        
        return [
            'id' => $planta->id,
            'programacaoMaisRecente' => $programacaoMaisRecente
        ];
    }
}
