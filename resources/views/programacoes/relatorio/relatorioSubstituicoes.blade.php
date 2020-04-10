<table>
    <thead>
    
    <tr>
        <th><strong>Cód. QRCode</strong></th>
        <th><strong>Descrição</strong></th>
        <th><strong>Circuito</strong></th>
        <th><strong>Quant.</strong></th>
        <th><strong>Tipo</strong></th>
        <th><strong>Pot.(W)</strong></th>
        <th><strong>Tensão (V)</strong></th>
        <th><strong>Base/Tipo</strong></th>
        <th><strong>Reator/Tipo</strong></th>
        <th><strong>Lâmpada</strong></th>        
        <th><strong>Reator</strong></th>        
        <th><strong>Base</strong></th>        
        <th><strong>Data Manutenção</strong></th>                
        <th><strong>Horário Início</strong></th>                
        <th><strong>Horário Conclusão</strong></th>                
        <th><strong>Comentários</strong></th>               
    </tr>
    </thead>
    <tbody>
    
    {!!
        $itens = $programacao->planta->itens()->with(
                    [
                        'materiais' => function ($query) {
                            $query->whereHas(
                                'tipoMaterial', function ($query) {
                                    $query->whereIn('tipo', ['Lâmpada', 'Outros']);
                                }
                            );
                        },
                        'materiais.tipoMaterial', 
                        'materiais.reator',
                        'materiais.base',
                        'materiais.potencia',
                        'materiais.tensao',
                    ]
                )->orderBy('qrcode')->get();

    !!}
    
    
    @foreach($itens as $item)
        {!! 
            $materiais = $item->materiais;
            
            if ($item->materiais->count() > 0) {
                $primeiroMaterial = $materiais[0];
                $querySubstLampada = $programacao->quantidadesSubstituidas()->whereItemId($item->id)->whereMaterialId($primeiroMaterial->id)->get()->first();                    
                $materiais->pull(0);
            } else {
                $primeiroMaterial = null;
                $querySubstLampada = null;
            }
            
            $qtdeSubstLampada = !is_null($querySubstLampada) && !empty($querySubstLampada) ? $querySubstLampada->quantidade_substituida : '';            
            $qtdeSubstReator = !is_null($querySubstLampada) && !empty($querySubstLampada) && $primeiroMaterial->reator ? $querySubstLampada->quantidade_substituida_reator : '';                    
            $qtdeSubstBase = !is_null($querySubstLampada) && !empty($querySubstLampada) && $primeiroMaterial->base ? $querySubstLampada->quantidade_substituida_base : '';                    
            
            $comentario = \App\Models\Comentario::where('programacao_id',$programacao->id)->where('item_id', $item->id)->first();
            $dataManutencao = \App\Models\DataManutencao::where('programacao_id',$programacao->id)->where('item_id', $item->id)->first();

            
        !!}
        
        <tr>                
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ $item->qrcode }}</th>
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ $item->nome }}</th>
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ $item->circuito }}</th>
            <td>{{ !is_null($primeiroMaterial) && !is_null($primeiroMaterial->pivot->quantidade_instalada) ? $primeiroMaterial->pivot->quantidade_instalada : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial) && !is_null($primeiroMaterial->tipoMaterial) ? $primeiroMaterial->tipoMaterial->abreviacao : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial) && !is_null($primeiroMaterial->potencia) ? $primeiroMaterial->potencia->valor : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial) && !is_null($primeiroMaterial->tensao) ? $primeiroMaterial->tensao->valor : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial) && !is_null($primeiroMaterial->base) ? $primeiroMaterial->base->abreviacao : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial) && !is_null($primeiroMaterial->reator) ? $primeiroMaterial->reator->tipo_reator_qtde.'x'.$primeiroMaterial->reator->potencia->valor : '' }}</td>  
            <td>{{ $qtdeSubstLampada }} </td>      
            <td>{{ $qtdeSubstReator }} </td>      
            <td>{{ $qtdeSubstBase }} </td> 
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ !is_null($dataManutencao) ? $dataManutencao->data_inicio->format('d/m/Y') : '' }} </th> 
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ !is_null($dataManutencao) ? $dataManutencao->data_inicio->format('H:i:s') : '' }} </th> 
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ !is_null($dataManutencao) ? $dataManutencao->data_fim->format('H:i:s') : '' }} </th> 
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ !is_null($comentario) ? $comentario->comentario : '' }} </th> 
            
        </tr>

        @foreach ($materiais as $material)
            
            {!!
                $querySubstLampada = $programacao->quantidadesSubstituidas()->whereItemId($item->id)->whereMaterialId($material->id)->get()->first();                    
                $qtdeSubstLampada = !is_null($querySubstLampada) && !empty($querySubstLampada) ? $querySubstLampada->quantidade_substituida : '';
                $qtdeSubstReator = !is_null($querySubstLampada) && !empty($querySubstLampada) && $material->reator ? $querySubstLampada->quantidade_substituida_reator : '';                    
                $qtdeSubstBase = !is_null($querySubstLampada) && !empty($querySubstLampada) &&  $material->base ? $querySubstLampada->quantidade_substituida_base : '';                    

            !!}            
        
            <tr>                                
                <td>{{ $material->pivot->quantidade_instalada }}</td>                
                <td>{{ !is_null($material->tipoMaterial) ? $material->tipoMaterial->abreviacao : '' }}</td>                
                <td>{{ !is_null($material->potencia) ? $material->potencia->valor : '' }}</td>                
                <td>{{ !is_null($material->tensao) ? $material->tensao->valor : '' }}</td>                
                <td>{{ !is_null($material->base) ? $material->base->abreviacao : '' }}</td>                
                <td>{{ !is_null($material->reator) ? $material->reator->tipo_reator_qtde.'x'.$material->reator->potencia->valor : '' }}</td>  
                <td>{{ $qtdeSubstLampada }} </td>      
                <td>{{ $qtdeSubstReator }} </td>      
                <td>{{ $qtdeSubstBase }} </td>
            </tr>  
        @endforeach  
        
    @endforeach
    </tbody>
</table>
