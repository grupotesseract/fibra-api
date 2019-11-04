<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id') !!}
    <p>{!! $programacao->id !!}</p>
</div>

<!-- Data Inicio Prevista Field -->
<div class="form-group">
    {!! Form::label('data_inicio_prevista', 'Data Inicio Prevista') !!}
    <p>{!! $programacao->dataInicioPrevistaFormatada !!}</p>
</div>

<!-- Data Fim Prevista Field -->
<div class="form-group">
    {!! Form::label('data_fim_prevista', 'Data Fim Prevista') !!}
    <p>{!! $programacao->dataFimPrevistaFormatada !!}</p>
</div>

<!-- Data Inicio Real Field -->
<div class="form-group">
    {!! Form::label('data_inicio_real', 'Data Inicio Real') !!}
    <p>{!! $programacao->dataInicioRealFormatada !!}</p>
</div>

<!-- Data Fim Real Field -->
<div class="form-group">
    {!! Form::label('data_fim_real', 'Data Fim Real') !!}
    <p>{!! $programacao->dataFimRealFormatada !!}</p>
</div>

<!-- Planta Id Field -->
<div class="form-group">
    {!! Form::label('planta_id', 'Planta') !!}
    <p>{!! $programacao->planta->nome !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em') !!}
    <p>{!! $programacao->created_at->format('d/m/y H:i:s') !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em') !!}
    <p>{!! $programacao->updated_at->format('d/m/y H:i:s') !!}</p>
</div>

