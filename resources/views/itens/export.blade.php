<table>
    <thead>
    <tr>
        <th>Descrição</th>
        <th>Circuito</th>
        <th>Quant.</th>
    </tr>
    </thead>
    <tbody>
    @foreach($itens as $item)

        @foreach ($item->materiais as $material)
            <tr>
                <td>{{ $loop->first ? $item->nome : '' }}</td>
                <td>{{ $loop->first ? $item->circuito : '' }}</td>
                <td>{{ $material->pivot->quantidade_instalada }}</td>                
            </tr>  
        @endforeach        
        
    @endforeach
    </tbody>
</table>
