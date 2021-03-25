<table>
    <thead>
    <tr>
        <th><strong>Descrição</strong></th>
        <th><strong>Tensão</strong></th>
        <th><strong>Pot.(W)</strong></th>
        <th><strong>Base</strong></th>
        <th><strong>Reator</strong></th>
        <th><strong>Quantidade Instalada</strong></th>
        <th><strong>Quantidade Mínima para Manutenção</strong></th>
        <th><strong>Quantidade em Estoque no Início da Manutenção</strong></th>
        <th><strong>Quantidade de Entrada de Material</strong></th>
        <th><strong>Quantidade em Estoque no Final da Manutenção</strong></th>
        <th><strong>Quantidade Materiais Substituídos</strong></th>
        <th><strong>Materiais Necessários para Próxima Manutenção</strong></th>
    </tr>
    </thead>
    <tbody>

    {!!
        $itensId = $programacao->planta->itens()->pluck('id');
        $materiaisId = \DB::table('itens_materiais')->whereIn('item_id',$itensId)->pluck('material_id');
        $materiaisIdQtde = $programacao->planta->quantidadesMinimas->pluck('material_id');
        $materiaisId = array_merge($materiaisId->toArray(), $materiaisIdQtde->toArray());

        $materiais = \App\Models\Material::with('tipoMaterial')->whereIn('id',$materiaisId)->orderBy('nome')->get()->sortBy(function($item) {
            $tipo = $item->tipoMaterial ? $item->tipoMaterial->tipo.'-'.$item->tipoMaterial->nome : $item->nome;
            return $tipo;
        });

    !!}

    @foreach ($materiais as $material)

        @if (!is_null($material))
            {!!
                $qtdeInstalada = $material->items()->whereHas(
                    'planta', function ($query) use ($programacao) {
                        $query->where('id',$programacao->planta->id);
                    }
                )->sum('quantidade_instalada');

                $qtdeMinima = $programacao->planta->quantidadesMinimas()->whereHas(
                    'material', function ($query) use ($material) {
                        $query->where('id', $material->id);
                    }
                )->get()->first();

                $estoque = $material->estoques()->whereHas(
                    'programacao', function ($query) use ($programacao) {
                        $query->where('id',$programacao->id);
                    }
                )->get()->first();

                $entrada = $material->entradas()->whereHas(
                    'programacao', function ($query) use ($programacao) {
                        $query->where('id',$programacao->id);
                    }
                )->get()->first();

                if (!is_null($estoque))
                {
                    $qtdeEstoqueInicial = $estoque->quantidade_inicial;
                    $qtdeEstoqueFinal = $estoque->quantidade_final;
                }
                else {
                    $qtdeEstoqueInicial = 0;
                    $qtdeEstoqueFinal = 0;
                }

                if (!is_null($entrada))
                {
                    $qtdeEntrada = $entrada->quantidade;
                }
                else {
                    $qtdeEntrada = 0;
                }

                if (!is_null($qtdeMinima))
                {
                    $qtdeMinimaQnt = $qtdeMinima->quantidade_minima;
                }
                else {
                    $qtdeMinimaQnt = 0;
                }



                if (!is_null($material->tipoMaterial)) {
                    if ($material->tipoMaterial->tipo === 'Lâmpada' || $material->tipoMaterial->tipo === 'Outros') {
                        $qtdeSubst = $programacao->quantidadesSubstituidas()->whereMaterialId($material->id)->sum('quantidade_substituida');
                        $reator = !is_null($material->reator) ? $material->reator->tipo_reator_qtde.'x'.$material->reator->potencia->valor : '';
                        $base = !is_null($material->base) ? $material->base->abreviacao : '';
                    } else if ($material->tipoMaterial->tipo === 'Reator') {
                        $qtdeSubst = $programacao->quantidadesSubstituidas()->whereReatorId($material->id)->sum('quantidade_substituida_reator');
                        $reator = $material->tipo_reator_qtde.'x'.$material->potencia->valor;
                        $base = '';
                    }
                }
                else {
                    $qtdeSubst = $programacao->quantidadesSubstituidas()->whereBaseId($material->id)->sum('quantidade_substituida_base');
                    $reator = '';
                    $base = $material->abreviacao;
                }

                $qtdeNecessaria = $qtdeMinimaQnt - $qtdeEstoqueFinal;


        !!}

        <tr>
            <td>{{ !is_null($material->tipoMaterial) ? $material->tipoMaterial->tipo ." ". $material->tipoMaterial->nome : $material->nome }}</td>
            <td>{{ !is_null($material->tensao) ? $material->tensao->valor : '' }}</td>
            <td>{{ !is_null($material->potencia) ? $material->potencia->valor : '' }}</td>
            <td>{{ $base }}</td>
            <td>{{ $reator }}</td>
            <td>{{ !is_null($qtdeInstalada) ? $qtdeInstalada : '' }}</td>
            <td>{{ !is_null($qtdeMinimaQnt) ? $qtdeMinimaQnt : '' }}</td>
            <td>{{ !is_null($qtdeEstoqueInicial) ? $qtdeEstoqueInicial : '' }}</td>
            <td>{{ !is_null($qtdeEntrada) ? $qtdeEntrada : '' }}</td>
            <td>{{ !is_null($qtdeEstoqueFinal) ? $qtdeEstoqueFinal : '' }}</td>
            <td>{{ !is_null($qtdeSubst) ? $qtdeSubst : '' }}</td>
            <td>{{ !is_null($qtdeNecessaria) && ($qtdeNecessaria > 0) ? $qtdeNecessaria : 0 }}</td>
        </tr>

        @endif

    @endforeach

    </tbody>
</table>
