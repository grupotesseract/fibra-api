<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $usuarioManutencao->id }}</p>
</div>

<!-- Manutencao Id Field -->
<div class="form-group">
    {!! Form::label('manutencao_id', 'Manutencao Id:') !!}
    <p>{{ $usuarioManutencao->manutencao_id }}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('usuario_id', 'Usuario Id:') !!}
    <p>{{ $usuarioManutencao->usuario_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $usuarioManutencao->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $usuarioManutencao->updated_at }}</p>
</div>

