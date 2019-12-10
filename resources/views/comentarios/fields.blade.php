<!-- Item Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_id', 'Item Id:') !!}
    {!! Form::text('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Programacao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programacao_id', 'Programacao Id:') !!}
    {!! Form::text('programacao_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Comentario Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comentario', 'Comentario:') !!}
    {!! Form::textarea('comentario', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('comentarios.index') }}" class="btn btn-secondary">Cancel</a>
</div>
