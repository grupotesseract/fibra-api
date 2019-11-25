<table>
    <thead>
    <tr>
        <th><strong>Descrição</strong></th>        
        <th><strong>Pot.(W)</strong></th>
        <th><strong>Tensão</strong></th>
        <th><strong>Base/Tipo</strong></th>
        <th><strong>Reator/Tipo</strong></th>        
    </tr>
    </thead>
    <tbody>
    
    {!!
        $materiais = $programacao->planta->quantidadesMinimas()->with(['material.reator', 'material.base', 'material.tensao', 'material.potencia'])->get()->pluck('material');
    !!}
        
    @foreach ($materiais as $material)
        
        <tr>                
            <td>{{ !is_null($material->tipoMaterial) ? $material->tipoMaterial->nome : '' }}</td>                
            <td>{{ !is_null($material->potencia) ? $material->potencia->valor : '' }}</td>                
            <td>{{ !is_null($material->tensao) ? $material->tensao->valor : '' }}</td>                
            <td>{{ !is_null($material->base) ? $material->base->nome : '' }}</td>                
            <td>{{ !is_null($material->reator) ? $material->reator->nome : '' }}</td>              
        </tr>  

    @endforeach        
        
    </tbody>
</table>
