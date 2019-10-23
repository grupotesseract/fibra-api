<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $estoque->id !!}</p>
</div>

<!-- Material Id Field -->
<div class="form-group">
    {!! Form::label('material_id', 'Material Id:') !!}
    <p>{!! $estoque->material_id !!}</p>
</div>

<!-- Programacao Id Field -->
<div class="form-group">
    {!! Form::label('programacao_id', 'Programacao Id:') !!}
    <p>{!! $estoque->programacao_id !!}</p>
</div>

<!-- Quantidade Inicial Field -->
<div class="form-group">
    {!! Form::label('quantidade_inicial', 'Quantidade Inicial:') !!}
    <p>{!! $estoque->quantidade_inicial !!}</p>
</div>

<!-- Quantidade Final Field -->
<div class="form-group">
    {!! Form::label('quantidade_final', 'Quantidade Final:') !!}
    <p>{!! $estoque->quantidade_final !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $estoque->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $estoque->updated_at !!}</p>
</div>

