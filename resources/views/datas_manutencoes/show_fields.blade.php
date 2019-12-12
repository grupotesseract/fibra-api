<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $dataManutencao->id }}</p>
</div>

<!-- Programacao Id Field -->
<div class="form-group">
    {!! Form::label('programacao_id', 'Programacao Id:') !!}
    <p>{{ $dataManutencao->programacao_id }}</p>
</div>

<!-- Item Id Field -->
<div class="form-group">
    {!! Form::label('item_id', 'Item Id:') !!}
    <p>{{ $dataManutencao->item_id }}</p>
</div>

<!-- Data Inicio Field -->
<div class="form-group">
    {!! Form::label('data_inicio', 'Data Inicio:') !!}
    <p>{{ $dataManutencao->data_inicio }}</p>
</div>

<!-- Data Fim Field -->
<div class="form-group">
    {!! Form::label('data_fim', 'Data Fim:') !!}
    <p>{{ $dataManutencao->data_fim }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $dataManutencao->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $dataManutencao->updated_at }}</p>
</div>

