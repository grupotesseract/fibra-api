<!-- Item Id Field -->
{!! Form::hidden('item_id', null) !!}

<!-- Programacao Id Field -->
{!! Form::hidden('programacao_id', null) !!}

<!-- Comentario Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comentario', 'Comentario:') !!}
    {!! Form::textarea('comentario', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
</div>
