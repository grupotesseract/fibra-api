<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $manutencaoCivilEletrica->id }}</p>
</div>

<!-- Data Hora Entrada Field -->
<div class="form-group">
    {!! Form::label('data_hora_entrada', 'Data Hora Entrada:') !!}
    <p>{{ $manutencaoCivilEletrica->data_hora_entrada->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Data Hora Saida Field -->
<div class="form-group">
    {!! Form::label('data_hora_saida', 'Data Hora Saida:') !!}
    <p>{{ $manutencaoCivilEletrica->data_hora_saida->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Data Hora Inicio Lem Field -->
<div class="form-group">
    {!! Form::label('data_hora_inicio_lem', 'Data Hora Inicio Lem:') !!}
    <p>{{ $manutencaoCivilEletrica->data_hora_inicio_lem->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Data Hora Final Lem Field -->
<div class="form-group">
    {!! Form::label('data_hora_final_lem', 'Data Hora Final Lem:') !!}
    <p>{{ $manutencaoCivilEletrica->data_hora_final_lem->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Data Hora Inicio Let Field -->
<div class="form-group">
    {!! Form::label('data_hora_inicio_let', 'Data Hora Inicio Let:') !!}
    <p>{{ $manutencaoCivilEletrica->data_hora_inicio_let->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Data Hora Final Let Field -->
<div class="form-group">
    {!! Form::label('data_hora_final_let', 'Data Hora Final Let:') !!}
    <p>{{ $manutencaoCivilEletrica->data_hora_final_let->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Data Hora Inicio Atividades Field -->
<div class="form-group">
    {!! Form::label('data_hora_inicio_atividades', 'Data Hora Inicio Atividades:') !!}
    <p>{{ $manutencaoCivilEletrica->data_hora_inicio_atividades->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Planta Id Field -->
<div class="form-group">
    {!! Form::label('planta_id', 'Planta:') !!}
    <p>{{ $manutencaoCivilEletrica->planta->nome }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em:') !!}
    <p>{{ $manutencaoCivilEletrica->created_at->format('d/m/Y H:i:s') }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em:') !!}
    <p>{{ $manutencaoCivilEletrica->updated_at->format('d/m/Y H:i:s') }}</p>
</div>

