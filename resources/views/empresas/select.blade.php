{{-- Blade para select de cidades --}}

@if (isset($Model) && $Model->empresa)

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('empresas', 'Empresa') !!} <br>
    {!! Form::select('empresa_id', $empresas, $Model->empresa->id, ['class' => 'form-control']
    ) !!}
</div>

@else

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('empresas', 'Empresa') !!} <br>
    {!! Form::select('empresa_id', [''=>'']+$empresas, null, ['class' => 'form-control']
    ) !!}
</div>

@endif
