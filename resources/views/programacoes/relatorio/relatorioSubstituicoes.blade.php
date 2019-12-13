<table>
    <thead>
    
    <tr>
        <th><strong>Descrição</strong></th>
        <th><strong>Circuito</strong></th>
        <th><strong>Quant.</strong></th>
        <th><strong>Tipo</strong></th>
        <th><strong>Pot.(W)</strong></th>
        <th><strong>Tensão</strong></th>
        <th><strong>Base/Tipo</strong></th>
        <th><strong>Reator/Tipo</strong></th>
        <th><strong>Lâmpada</strong></th>        
        <th><strong>Reator</strong></th>        
        <th><strong>Base</strong></th>        
        <th><strong>Data Manutenção</strong></th>                
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
                                    $query->where('tipo', 'Lâmpada');
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
            $primeiroMaterial = $materiais[0];
            $querySubstLampada = $programacao->quantidadesSubstituidas()->whereItemId($item->id)->whereMaterialId($primeiroMaterial->id)->get()->first();                    
            $qtdeSubstLampada = !is_null($querySubstLampada) && !empty($querySubstLampada) ? $querySubstLampada->quantidade_substituida : '';
            $data_manutencao = !is_null($querySubstLampada) && !empty($querySubstLampada) ? $querySubstLampada->data_manutencao->format('d/m/Y H:i:s') : '';
            
            if(!is_null($primeiroMaterial->reator)) {
                $querySubstReator = $programacao->quantidadesSubstituidas()->whereItemId($item->id)->whereMaterialId($primeiroMaterial->reator->id)->get()->first();                    
                $qtdeSubstReator = !is_null($querySubstReator) && !empty($querySubstReator) ? $querySubstReator->quantidade_substituida : '';
            }
            else {
                $querySubstReator = '';
            }
            
            if(!is_null($primeiroMaterial->base)) {
                $querySubstBase = $programacao->quantidadesSubstituidas()->whereItemId($item->id)->whereMaterialId($primeiroMaterial->base->id)->get()->first();                    
                $qtdeSubstBase = !is_null($querySubstBase) && !empty($querySubstBase) ? $querySubstBase->quantidade_substituida : '';
            }
            else {
                $qtdeSubstBase = '';
            }

            
            $comentario = \App\Models\Comentario::where('programacao_id',$programacao->id)->where('item_id', $item->id)->first();

            $materiais->pull(0);
        !!}
        
        <tr>                
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ $item->nome }}</th>
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ $item->circuito }}</th>
            <td>{{ $primeiroMaterial->pivot->quantidade_instalada }}</td>                
            <td>{{ !is_null($primeiroMaterial->tipoMaterial) ? $primeiroMaterial->tipoMaterial->abreviacao : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial->potencia) ? $primeiroMaterial->potencia->valor : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial->tensao) ? $primeiroMaterial->tensao->valor : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial->base) ? $primeiroMaterial->base->abreviacao : '' }}</td>                
            <td>{{ !is_null($primeiroMaterial->reator) ? $primeiroMaterial->reator->tipoMaterial->abreviacao : '' }}</td>  
            <td>{{ $qtdeSubstLampada }} </td>      
            <td>{{ $querySubstReator }} </td>      
            <td>{{ $qtdeSubstBase }} </td> 
            <td>{{ $data_manutencao }} </td> 
            <th rowspan="{{ $item->materiais->count() + 1 }}">{{ !is_null($comentario) ? $comentario->comentario : '' }} </th> 
            
        </tr>


        
        @foreach ($materiais as $material)
            
            {!!
                $querySubstLampada = $programacao->quantidadesSubstituidas()->whereItemId($item->id)->whereMaterialId($material->id)->get()->first();                    
                $qtdeSubstLampada = !is_null($querySubstLampada) && !empty($querySubstLampada) ? $querySubstLampada->quantidade_substituida : '';
                $data_manutencao = !is_null($querySubstLampada) && !empty($querySubstLampada) ? $querySubstLampada->data_manutencao->format('d/m/Y H:i:s') : '';
                
                if(!is_null($material->reator)) {
                    $querySubstReator = $programacao->quantidadesSubstituidas()->whereItemId($item->id)->whereMaterialId($material->reator->id)->get()->first();                    
                    $qtdeSubstReator = !is_null($querySubstReator) && !empty($querySubstReator) ? $querySubstReator->quantidade_substituida : '';
                }
                else {
                    $querySubstReator = '';
                }
                
                if(!is_null($material->base)) {
                    $querySubstBase = $programacao->quantidadesSubstituidas()->whereItemId($item->id)->whereMaterialId($material->base->id)->get()->first();                    
                    $qtdeSubstBase = !is_null($querySubstBase) && !empty($querySubstBase) ? $querySubstBase->quantidade_substituida : '';
                }
                else {
                    $qtdeSubstBase = '';
                }
            !!}            
        
            <tr>                
                <td>{{ $material->pivot->quantidade_instalada }}</td>                
                <td>{{ !is_null($material->tipoMaterial) ? $material->tipoMaterial->abreviacao : '' }}</td>                
                <td>{{ !is_null($material->potencia) ? $material->potencia->valor : '' }}</td>                
                <td>{{ !is_null($material->tensao) ? $material->tensao->valor : '' }}</td>                
                <td>{{ !is_null($material->base) ? $material->base->abreviacao : '' }}</td>                
                <td>{{ !is_null($material->reator) ? $material->reator->tipoMaterial->abreviacao : '' }}</td>  
                <td>{{ $qtdeSubstLampada }} </td>      
                <td>{{ $querySubstReator }} </td>      
                <td>{{ $qtdeSubstBase }} </td>
                <td>{{ $data_manutencao }} </td>       

            </tr>  
        @endforeach        
        
    @endforeach
    </tbody>
</table>