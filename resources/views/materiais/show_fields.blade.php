<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id') !!}
    <p>{!! $material->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome') !!}
    <p>{!! $material->nome !!}</p>
</div>

<!-- Potencia Field -->
<div class="form-group">
    {!! Form::label('potencia', 'Potência') !!}
    <p>{!! $material->potencia !!}</p>
</div>

<!-- Tensao Field -->
<div class="form-group">
    {!! Form::label('tensao', 'Tensão') !!}
    <p>{!! $material->tensao !!}</p>
</div>

<!-- Tipo Material Id Field -->
<div class="form-group">
    {!! Form::label('tipo_material_id', 'Tipo de Material') !!}
    <p>{!! $material->tipoMaterial->nome !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em') !!}
    <p>{!! $material->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado') !!}
    <p>{!! $material->updated_at !!}</p>
</div>

