{!! Form::hidden('material_id', $estoque->material->id) !!}
{!! Form::hidden('programacao_id', $estoque->programacao->id) !!}

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
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! url()->previous() !!}" class="btn btn-default">Cancelar</a>
</div>
