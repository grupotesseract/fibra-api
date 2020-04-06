<!-- Manutencao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('manutencao_id', 'Manutencao Id:') !!}
    {!! Form::text('manutencao_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Usuario Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    {!! Form::text('usuario_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('usuariosManutencoes.index') }}" class="btn btn-secondary">Cancelar</a>
</div>
