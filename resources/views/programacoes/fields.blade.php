<!-- Data Inicio Prevista Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_inicio_prevista', 'Data Inicio Prevista') !!}
    {!! Form::text('data_inicio_prevista_form', isset($programacao) && !is_null($programacao->data_inicio_prevista) ? $programacao->data_inicio_prevista->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control','id'=>'data_inicio_prevista_form']) !!}
    {!! Form::hidden('data_inicio_prevista', isset($programacao) && !is_null($programacao->data_inicio_prevista) ? $programacao->data_inicio_prevista : null) !!}
</div>


<!-- Data Fim Prevista Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_fim_prevista', 'Data Fim Prevista') !!}
    {!! Form::text('data_fim_prevista_form', isset($programacao) && !is_null($programacao->data_fim_prevista) ? $programacao->data_fim_prevista->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control','id'=>'data_fim_prevista']) !!}
    {!! Form::hidden('data_fim_prevista', isset($programacao) && !is_null($programacao->data_fim_prevista) ? $programacao->data_fim_prevista : null) !!}
</div>

<!-- Data Inicio Real Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_inicio_real_form', 'Data Inicio Real') !!}
    {!! Form::text('data_inicio_real_form', isset($programacao) && !is_null($programacao->data_inicio_real) ? $programacao->data_inicio_real->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control','id'=>'data_inicio_real']) !!}
    {!! Form::hidden('data_inicio_real', isset($programacao) && !is_null($programacao->data_inicio_real) ? $programacao->data_inicio_real : null) !!}
</div>

<!-- Data Fim Real Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_fim_real_form', 'Data Fim Real') !!}
    {!! Form::text('data_fim_real_form', isset($programacao) && !is_null($programacao->data_fim_real) ? $programacao->data_fim_real->format('d/m/Y H:i:s') : null, ['class' => 'datepicker form-control','id'=>'data_fim_real']) !!}
    {!! Form::hidden('data_fim_real', isset($programacao) && !is_null($programacao->data_fim_real) ? $programacao->data_fim_real : null) !!}
</div>


<!-- Planta Id Field -->
<!-- Empresa Id Field -->
@if (isset($programacao))

    <div class="form-group col-sm-6">
        @include('plantas.select', [
            'Model' => $programacao
        ])
    </div>

@else

    <div class="form-group col-sm-6">
        @include('plantas.select')
    </div>

@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('programacoes.index') !!}" class="btn btn-default">Cancelar</a>
</div>

