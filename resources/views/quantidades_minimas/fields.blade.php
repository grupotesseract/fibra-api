<!-- Material Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('material_id', 'Material Id:') !!}
    {!! Form::text('material_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Planta Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('planta_id', 'Planta Id:') !!}
    {!! Form::text('planta_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantidade Minima Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantidade_minima', 'Quantidade Minima:') !!}
    {!! Form::number('quantidade_minima', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('quantidadesMinimas.index') !!}" class="btn btn-default">Cancel</a>
</div>
