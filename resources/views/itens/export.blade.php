<table>
    <thead>
    <tr>
        <th><strong>Descrição</strong></th>
        <th><strong>Circuito</strong></th>
        <th><strong>Quant.</strong></th>
        <th><strong></strong></th>
        <th><strong>Pot.(W)</strong></th>
        <th><strong>Tensão</strong></th>
        <th><strong>E27 / E/40</strong></th>
        <th><strong>Reator/Tipo</strong></th>
        <th><strong>Lampada</strong></th>
        <th><strong>Reator</strong></th>
        <th><strong>Receptáculo</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($itens as $item)
        
        @foreach ($item->materiais as $material)
            <tr>
                <td>{{ $loop->first ? $item->nome : '' }}</td>
                <td>{{ $loop->first ? $item->circuito : '' }}</td>
                <td>{{ $material->pivot->quantidade_instalada }}</td>                
                <td>{{ !is_null($material->tipoMaterial) ? $material->tipoMaterial->abreviacao : '' }}</td>                
                <td>{{ !is_null($material->potencia) ? $material->potencia->valor : '' }}</td>                
                <td>{{ !is_null($material->tensao) ? $material->tensao->valor : '' }}</td>                
                <td>{{ !is_null($material->base) ? $material->base->nome : '' }}</td>                
                <td>{{ !is_null($material->reator) ? $material->reator->nome : '' }}</td>                
            </tr>  
        @endforeach        
        
    @endforeach
    </tbody>
</table>
