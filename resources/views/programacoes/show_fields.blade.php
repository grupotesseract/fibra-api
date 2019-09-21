<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id') !!}
    <p>{!! $programacao->id !!}</p>
</div>

<!-- Data Inicio Prevista Field -->
<div class="form-group">
    {!! Form::label('data_inicio_prevista', 'Data Inicio Prevista') !!}
    <p>{!! $programacao->data_inicio_prevista !!}</p>
</div>

<!-- Data Fim Prevista Field -->
<div class="form-group">
    {!! Form::label('data_fim_prevista', 'Data Fim Prevista') !!}
    <p>{!! $programacao->data_fim_prevista !!}</p>
</div>

<!-- Data Inicio Real Field -->
<div class="form-group">
    {!! Form::label('data_inicio_real', 'Data Inicio Real') !!}
    <p>{!! $programacao->data_inicio_real !!}</p>
</div>

<!-- Data Fim Real Field -->
<div class="form-group">
    {!! Form::label('data_fim_real', 'Data Fim Real') !!}
    <p>{!! $programacao->data_fim_real !!}</p>
</div>

<!-- Planta Id Field -->
<div class="form-group">
    {!! Form::label('planta_id', 'Planta') !!}
    <p>{!! $programacao->planta->nome !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em') !!}
    <p>{!! $programacao->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em') !!}
    <p>{!! $programacao->updated_at !!}</p>
</div>

