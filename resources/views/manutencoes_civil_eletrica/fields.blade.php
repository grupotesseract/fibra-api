<!-- Data Hora Entrada Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_hora_entrada', 'Data Hora Entrada:') !!}
    {!! Form::text('data_hora_entrada', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Hora Saida Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_hora_saida', 'Data Hora Saida:') !!}
    {!! Form::text('data_hora_saida', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Hora Inicio Lem Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_hora_inicio_lem', 'Data Hora Inicio Lem:') !!}
    {!! Form::text('data_hora_inicio_lem', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Hora Final Lem Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_hora_final_lem', 'Data Hora Final Lem:') !!}
    {!! Form::text('data_hora_final_lem', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Hora Inicio Let Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_hora_inicio_let', 'Data Hora Inicio Let:') !!}
    {!! Form::text('data_hora_inicio_let', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Hora Final Let Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_hora_final_let', 'Data Hora Final Let:') !!}
    {!! Form::text('data_hora_final_let', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Hora Inicio Atividades Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_hora_inicio_atividades', 'Data Hora Inicio Atividades:') !!}
    {!! Form::text('data_hora_inicio_atividades', null, ['class' => 'form-control']) !!}
</div>

<!-- Planta Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('planta_id', 'Planta Id:') !!}
    {!! Form::text('planta_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('manutencoesCivilEletrica.index') }}" class="btn btn-secondary">Cancel</a>
</div>
