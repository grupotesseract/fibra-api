<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $dataManutencao->id }}</p>
</div>

<!-- Item Id Field -->
<div class="form-group">
    {!! Form::label('item_id', 'Item:') !!}
    <p>{{ $dataManutencao->item->nome }}</p>
</div>

<!-- Data Inicio Field -->
<div class="form-group">
    {!! Form::label('data_inicio', 'Data Inicio:') !!}
    <p>{{ $dataManutencao->data_inicio->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Data Fim Field -->
<div class="form-group">
    {!! Form::label('data_fim', 'Data Fim:') !!}
    <p>{{ $dataManutencao->data_fim->format('d/m/Y H:i:s') }}</p>
</div>


