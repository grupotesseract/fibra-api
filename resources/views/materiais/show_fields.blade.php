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

@if (isset($material) && $material->potencia)
    <!-- Potencia Field -->
    <div class="form-group">
        {!! Form::label('potencia', 'Potência') !!}
        <p>{!! $material->potencia->valor !!}</p>
    </div>
@endif

@if (isset($material) && $material->tensao)
    <!-- tensao Field -->
    <div class="form-group">
        {!! Form::label('tensao', 'Tensão') !!}
        <p>{!! $material->tensao->valor !!}</p>
    </div>
@endif


@if (isset($material) && $material->tipoMaterial)
<!-- Tipo Material Id Field -->
    <div class="form-group">
        {!! Form::label('tipo_material_id', 'Tipo de Material') !!}
        <p>{!! $material->tipoMaterial->nome !!}</p>
    </div>
@endif

@if (isset($material) && $material->reator)
<!-- Tipo Material Id Field -->

<div class="form-group">
    {!! Form::label('reator_id', 'Reator') !!}
    <p>{!! $material->reator->nome !!}</p>
</div>

@endif

@if (isset($material) && $material->receptaculo)
<!-- Tipo Material Id Field -->
<div class="form-group">
    {!! Form::label('receptaculo_id', 'Receptáculo') !!}
    <p>{!! $material->receptaculo->nome !!}</p>
</div>
@endif

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

