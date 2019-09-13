<!-- Data Inicio Prevista Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_inicio_prevista', 'Data Inicio Prevista') !!}
    {!! Form::text('data_inicio_prevista', null, ['class' => 'datepicker form-control','id'=>'data_inicio_prevista']) !!}
</div>


<!-- Data Fim Prevista Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_fim_prevista', 'Data Fim Prevista') !!}
    {!! Form::text('data_fim_prevista', null, ['class' => 'datepicker form-control','id'=>'data_fim_prevista']) !!}
</div>

<!-- Data Inicio Real Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_inicio_real', 'Data Inicio Real') !!}
    {!! Form::text('data_inicio_real', null, ['class' => 'datepicker form-control','id'=>'data_inicio_real']) !!}
</div>

<!-- Data Fim Real Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_fim_real', 'Data Fim Real') !!}
    {!! Form::text('data_fim_real', null, ['class' => 'datepicker form-control','id'=>'data_fim_real']) !!}
</div>


<!-- Planta Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('planta_id', 'Planta') !!}
    {!! Form::text('planta_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('programacoes.index') !!}" class="btn btn-default">Cancelar</a>
</div>
