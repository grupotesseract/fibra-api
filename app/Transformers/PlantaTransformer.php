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
            'id' => $planta->programacaoMaisRecente->id,
            'data_inicio_prevista' => $planta->programacaoMaisRecente->data_inicio_prevista,
            'data_fim_prevista' => $planta->programacaoMaisRecente->data_fim_prevista,
        ] : null;

        foreach ($planta->itens as $item) {
            $materiais = [];
            foreach ($item->materiais as $material) {
                $materiais[] = [
                    'id' => $material->id,
                    'nome' => $material->nome,
                    'base' => $material->baseNome,
                    'reator' => $material->reatorNome,
                    'quantidadeInstalada' => $material->pivot->quantidade_instalada
                ];
            }
            
            $itens[] = [
                'id' => $item->id,
                'nome' => $item->nome,
                'qrcode' => $item->qrcode,
                'circuito' => $item->circuito,
                'materiais' => $materiais ?? Array()
            ];
        }
        
        return [
            'id' => $planta->id,
            'nome' => $planta->nome,
            'programacaoMaisRecente' => $programacaoMaisRecente,
            'itens' => $itens
        ];
    }
}
