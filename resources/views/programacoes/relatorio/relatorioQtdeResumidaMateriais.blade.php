<table>
    <thead>
    <tr>
        <th><strong>Descrição</strong></th>        
        <th><strong>Tensão</strong></th>
        <th><strong>Pot.(W)</strong></th>
        <th><strong>Base</strong></th>
        <th><strong>Reatores</strong></th>        
        <th><strong>Quantidade Instalada</strong></th>        
        <th><strong>Quantidade Mínima para Manutenção</strong></th>        
        <th><strong>Quantidade em Estoque no Início da Manutenção</strong></th>        
        <th><strong>Quantidade em Estoque no Final da Manutenção</strong></th>        
        <th><strong>Quantidade Materiais Substituídos</strong></th>        
        <th><strong>Materiais Necessários para Próxima Manutenção</strong></th>        
    </tr>
    </thead>
    <tbody>
    
    {!!
        $materiais = $programacao->planta->quantidadesMinimas()->with(['material.reator', 'material.base', 'material.tensao', 'material.potencia'])->get()->pluck('material');
        
    !!}
        
    @foreach ($materiais as $material)
        
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
            )->get()->first()->quantidade_minima;

            $estoque = $material->estoques()->whereHas(
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

            $qtdeSubst = $programacao->quantidadesSubstituidas()->whereMaterialId($material->id)->sum('quantidade_substituida');

            $qtdeNecessaria = $qtdeMinima - $qtdeEstoqueFinal;


        !!}
        
        <tr>                
            <td>{{ !is_null($material->tipoMaterial) ? $material->tipoMaterial->nome : $material->nome }}</td>                
            <td>{{ !is_null($material->tensao) ? $material->tensao->valor : '' }}</td>                
            <td>{{ !is_null($material->potencia) ? $material->potencia->valor : '' }}</td>                
            <td>{{ !is_null($material->base) ? $material->base->abreviacao : '' }}</td>                
            <td>{{ !is_null($material->reator) ? $material->reator->tipoMaterial->abreviacao : '' }}</td>              
            <td>{{ !is_null($qtdeInstalada) ? $qtdeInstalada : '' }}</td>              
            <td>{{ !is_null($qtdeMinima) ? $qtdeMinima : '' }}</td>              
            <td>{{ !is_null($qtdeEstoqueInicial) ? $qtdeEstoqueInicial : '' }}</td>              
            <td>{{ !is_null($qtdeEstoqueFinal) ? $qtdeEstoqueFinal : '' }}</td>              
            <td>{{ !is_null($qtdeSubst) ? $qtdeSubst : '' }}</td>              
            <td>{{ !is_null($qtdeNecessaria) && ($qtdeNecessaria > 0) ? $qtdeNecessaria : 0 }}</td>              
        </tr>  

    @endforeach        
        
    </tbody>
</table>
