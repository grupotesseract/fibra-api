{{-- Blade para select de cidades --}}

@if (isset($Model) && $Model->tensao)

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('tensoes', 'Tensão') !!} <br>
    {!! Form::select('tensao_id', [null => 'Selecionar'] + $tensoes, $Model->tensao->id, ['class' => 'form-control select2']
    ) !!}
</div>

@else

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('tensoes', 'Tensão') !!} <br>
    {!! Form::select('tensao_id', [''=>'']+$tensoes, null, ['class' => 'form-control select2']
    ) !!}
</div>

@endif
