{!! Form::hidden('material_id', $entradaMaterial->material->id) !!}
{!! Form::hidden('programacao_id', $entradaMaterial->programacao->id) !!}

<!-- Quantidade Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantidade', 'Quantidade:') !!}
    {!! Form::number('quantidade', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! url()->previous() !!}" class="btn btn-default">Cancelar</a>
</div>
