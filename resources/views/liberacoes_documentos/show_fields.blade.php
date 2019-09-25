<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id') !!}
    <p>{!! $liberacaoDocumento->id !!}</p>
</div>

<!-- Programacao Id Field -->
<div class="form-group">
    {!! Form::label('programacao_id', 'Planta') !!}
    <p>{!! $liberacaoDocumento->programacao->planta->nome !!}</p>
</div>

<div class="form-group">
    {!! Form::label('programacao_id', 'Programação Data Inicio Prevista') !!}
    <p>{!! $liberacaoDocumento->programacao->data_inicio_prevista !!}</p>
</div>

<div class="form-group">
    {!! Form::label('programacao_id', 'Programação Data Fim Prevista') !!}
    <p>{!! $liberacaoDocumento->programacao->data_fim_prevista !!}</p>
</div>

<div class="form-group">
    {!! Form::label('programacao_id', 'Programação Data Inicio Real') !!}
    <p>{!! $liberacaoDocumento->programacao->data_inicio_real !!}</p>
</div>

<div class="form-group">
    {!! Form::label('programacao_id', 'Programação Data Fim Real') !!}
    <p>{!! $liberacaoDocumento->programacao->data_fim_real !!}</p>
</div>

<!-- Data Hora Field -->
<div class="form-group">
    {!! Form::label('data_hora', 'Data e Hora da Liberacao') !!}
    <p>{!! $liberacaoDocumento->data_hora !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em') !!}
    <p>{!! $liberacaoDocumento->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em') !!}
    <p>{!! $liberacaoDocumento->updated_at !!}</p>
</div>

