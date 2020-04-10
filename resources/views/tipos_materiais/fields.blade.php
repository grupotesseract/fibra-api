<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Abreviação Field -->
<div class="form-group col-sm-6">
    {!! Form::label('abreviacao', 'Abreviação') !!}
    {!! Form::text('abreviacao', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo', 'Tipo') !!}
    {!! Form::select('tipo', ['Lâmpada' => 'Lâmpada', 'Reator' => 'Reator', 'Outros' => 'Outros'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tiposMateriais.index') !!}" class="btn btn-default">Cancelar</a>
</div>
