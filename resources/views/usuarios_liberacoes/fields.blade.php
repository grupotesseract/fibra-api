<!-- Liberacao Documento Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('liberacao_documento_id', 'Liberacao Documento Id:') !!}
    {!! Form::text('liberacao_documento_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    {!! Form::text('usuario_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('usuariosLiberacoes.index') !!}" class="btn btn-default">Cancel</a>
</div>
