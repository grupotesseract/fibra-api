<!-- Material Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('material_id', 'Material Id:') !!}
    {!! Form::text('material_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Programacao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programacao_id', 'Programacao Id:') !!}
    {!! Form::text('programacao_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantidade Inicial Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantidade_inicial', 'Quantidade Inicial:') !!}
    {!! Form::number('quantidade_inicial', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantidade Final Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantidade_final', 'Quantidade Final:') !!}
    {!! Form::number('quantidade_final', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! url()->previous() !!}" class="btn btn-default">Cancel</a>
</div>
