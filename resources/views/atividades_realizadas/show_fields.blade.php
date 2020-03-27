<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $atividadeRealizada->id }}</p>
</div>

<!-- Texto Field -->
<div class="form-group">
    {!! Form::label('texto', 'Texto:') !!}
    <p>{{ $atividadeRealizada->texto }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $atividadeRealizada->status }}</p>
</div>

<!-- Manutencao Id Field -->
<div class="form-group">
    {!! Form::label('manutencao_id', 'Manutencao/Planta:') !!}
    <p>{{ $atividadeRealizada->manutencao->planta->nome }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em:') !!}
    <p>{{ $atividadeRealizada->created_at->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em:') !!}
    <p>{{ $atividadeRealizada->updated_at->format('d/m/Y H:i:s') }}</p>
</div>

