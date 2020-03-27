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
    {!! Form::label('manutencao_id', 'Manutencao Id:') !!}
    <p>{{ $atividadeRealizada->manutencao_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $atividadeRealizada->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $atividadeRealizada->updated_at }}</p>
</div>

