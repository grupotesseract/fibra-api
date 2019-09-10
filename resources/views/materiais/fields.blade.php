<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Potencia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('potencia', 'Potencia:') !!}
    {!! Form::text('potencia', null, ['class' => 'form-control']) !!}
</div>

<!-- Tensao Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tensao', 'Tensao:') !!}
    {!! Form::text('tensao', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Material Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_material_id', 'Tipo Material Id:') !!}
    {!! Form::text('tipo_material_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('materiais.index') !!}" class="btn btn-default">Cancel</a>
</div>
