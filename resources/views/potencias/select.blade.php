{{-- Blade para select de cidades --}}

@if (isset($Model) && $Model->potencia)

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('potencias', 'Potência') !!} <br>
    {!! Form::select('potencia_id', $potencias, $Model->potencia->id, ['class' => 'form-control select2']
    ) !!}
</div>

@else

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('potencias', 'Potência') !!} <br>
    {!! Form::select('potencia_id', [''=>'']+$potencias, null, ['class' => 'form-control select2']
    ) !!}
</div>

@endif
