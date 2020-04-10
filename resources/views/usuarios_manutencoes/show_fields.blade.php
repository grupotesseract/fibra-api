<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $usuarioManutencao->id }}</p>
</div>

<!-- Manutencao Id Field -->
<div class="form-group">
    {!! Form::label('manutencao_id', 'Manutencao/Planta:') !!}
    <p>{{ $usuarioManutencao->manutencao->planta->nome }}</p>
</div>

<!-- Usuario Id Field -->
<div class="form-group">
    {!! Form::label('usuario_id', 'Usuario:') !!}
    <p>{{ $usuarioManutencao->usuario->nome }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em:') !!}
    <p>{{ $usuarioManutencao->created_at->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em:') !!}
    <p>{{ $usuarioManutencao->updated_at->format('d/m/Y H:i:s') }}</p>
</div>

