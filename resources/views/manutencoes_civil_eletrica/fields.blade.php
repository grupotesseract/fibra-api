<div class="row">

    <div class="col-sm-5">
        <!-- Problemas Encontrados Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('problemas_encontrados', 'Problemas encontrados:') !!}
            {!! Form::textarea('problemas_encontrados', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>

        <!-- Informaões Adicionais Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('informacoes_adicionais', 'Informações Adicionais:') !!}
            {!! Form::textarea('informacoes_adicionais', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>

        <!-- Observações Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('observacoes', 'Observações:') !!}
            {!! Form::textarea('observacoes', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>

        <!-- IT Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('it', 'IT:') !!}
            {!! Form::textarea('it', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>

        <!-- LEM Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('lem', 'LEM:') !!}
            {!! Form::textarea('lem', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>

        <!-- LET Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('let', 'LET:') !!}
            {!! Form::textarea('let', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>

        <!-- OS Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('os', 'OS:') !!}
            {!! Form::textarea('os', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>

        <!-- Obra Atividade Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('obra_atividade', 'Obra Atividade:') !!}
            {!! Form::text('obra_atividade', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Equie Cliente Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('equipe_cliente', 'Equipe Cliente:') !!}
            {!! Form::text('equipe_cliente', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-sm-5">

        <!-- Data Hora Entrada Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('data_hora_entrada', 'Data Hora Entrada:') !!}
            {!! Form::text('data_hora_entrada_form', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_entrada) ? $manutencaoCivilEletrica->data_hora_entrada->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control']) !!}
            {!! Form::hidden('data_hora_entrada', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_entrada) ? $manutencaoCivilEletrica->data_hora_entrada : null, ['class' => 'form-control']) !!}
        </div>

        <!-- Data Hora Saida Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('data_hora_saida', 'Data Hora Saida:') !!}
            {!! Form::text('data_hora_saida_form', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_saida) ? $manutencaoCivilEletrica->data_hora_saida->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control']) !!}
            {!! Form::hidden('data_hora_saida', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_saida) ? $manutencaoCivilEletrica->data_hora_saida : null, ['class' => 'form-control']) !!}
        </div>

        <!-- Data Hora Inicio Lem Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('data_hora_inicio_lem', 'Data Hora Inicio Lem:') !!}
            {!! Form::text('data_hora_inicio_lem_form', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_inicio_lem) ? $manutencaoCivilEletrica->data_hora_inicio_lem->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control']) !!}
            {!! Form::hidden('data_hora_inicio_lem', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_inicio_lem) ? $manutencaoCivilEletrica->data_hora_inicio_lem : null, ['class' => 'form-control']) !!}
        </div>

        <!-- Data Hora Final Lem Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('data_hora_final_lem', 'Data Hora Final Lem:') !!}
            {!! Form::text('data_hora_final_lem_form', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_final_lem) ? $manutencaoCivilEletrica->data_hora_final_lem->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control']) !!}
            {!! Form::hidden('data_hora_final_lem', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_final_lem) ? $manutencaoCivilEletrica->data_hora_final_lem : null, ['class' => 'form-control']) !!}
        </div>

        <!-- Data Hora Inicio Let Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('data_hora_inicio_let', 'Data Hora Inicio Let:') !!}
            {!! Form::text('data_hora_inicio_let_form', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_inicio_let) ? $manutencaoCivilEletrica->data_hora_inicio_let->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control']) !!}
            {!! Form::hidden('data_hora_inicio_let', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_inicio_let) ? $manutencaoCivilEletrica->data_hora_inicio_let : null, ['class' => 'form-control']) !!}
        </div>

        <!-- Data Hora Final Let Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('data_hora_final_let', 'Data Hora Final Let:') !!}
            {!! Form::text('data_hora_final_let_form', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_final_let) ? $manutencaoCivilEletrica->data_hora_final_let->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control']) !!}
            {!! Form::hidden('data_hora_final_let', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_final_let) ? $manutencaoCivilEletrica->data_hora_final_let : null, ['class' => 'form-control']) !!}
        </div>

        <!-- Data Hora Inicio Atividades Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('data_hora_inicio_atividades', 'Data Hora Inicio Atividades:') !!}
            {!! Form::text('data_hora_inicio_atividades_form', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_inicio_atividades) ? $manutencaoCivilEletrica->data_hora_inicio_atividades->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control']) !!}
            {!! Form::hidden('data_hora_inicio_atividades', isset($manutencaoCivilEletrica) && !is_null($manutencaoCivilEletrica->data_hora_inicio_atividades) ? $manutencaoCivilEletrica->data_hora_inicio_atividades : null, ['class' => 'form-control']) !!}
        </div>

        <!-- Planta Id Field -->
        @if (isset($manutencaoCivilEletrica))

            <div class="form-group col-sm-12">
                @include('plantas.select', [
                    'Model' => $manutencaoCivilEletrica
                ])
            </div>

        @else
            <div class="form-group col-sm-12">
                @include('plantas.select')
            </div>
        @endif

    </div>

</div>

@if (isset($manutencaoCivilEletrica))
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('plantas.manutencoesCivilEletrica', $manutencaoCivilEletrica->planta_id) !!}" class="btn btn-secondary">Cancelar</a>
    </div>
@else
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('manutencoesCivilEletrica.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
@endif
