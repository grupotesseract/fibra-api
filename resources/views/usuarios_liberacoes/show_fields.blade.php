<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $usuarioLiberacao->id !!}</p>
</div>

<!-- Liberacao Documento Id Field -->
<div class="form-group">
    {!! Form::label('liberacao_documento_id', 'Liberacao Documento Id:') !!}
    <p>{!! $usuarioLiberacao->liberacao_documento_id !!}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    <p>{!! $usuarioLiberacao->usuario_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $usuarioLiberacao->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $usuarioLiberacao->updated_at !!}</p>
</div>

