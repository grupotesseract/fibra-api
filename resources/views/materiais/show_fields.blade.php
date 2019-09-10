<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $material->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{!! $material->nome !!}</p>
</div>

<!-- Potencia Field -->
<div class="form-group">
    {!! Form::label('potencia', 'Potencia:') !!}
    <p>{!! $material->potencia !!}</p>
</div>

<!-- Tensao Field -->
<div class="form-group">
    {!! Form::label('tensao', 'Tensao:') !!}
    <p>{!! $material->tensao !!}</p>
</div>

<!-- Tipo Material Id Field -->
<div class="form-group">
    {!! Form::label('tipo_material_id', 'Tipo Material Id:') !!}
    <p>{!! $material->tipo_material_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $material->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $material->updated_at !!}</p>
</div>

