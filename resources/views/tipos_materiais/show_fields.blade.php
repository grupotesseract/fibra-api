<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id') !!}
    <p>{!! $tipoMaterial->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome') !!}
    <p>{!! $tipoMaterial->nome !!}</p>
</div>

<!-- abreviacao Field -->
<div class="form-group">
    {!! Form::label('abreviacao', 'Abreviacao') !!}
    <p>{!! $tipoMaterial->abreviacao !!}</p>
</div>

<!-- Tipo Field -->
<div class="form-group">
    {!! Form::label('tipo', 'Tipo') !!}
    <p>{!! $tipoMaterial->tipo !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em') !!}
    <p>{!! $tipoMaterial->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em') !!}
    <p>{!! $tipoMaterial->updated_at !!}</p>
</div>

