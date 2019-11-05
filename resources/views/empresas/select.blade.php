{{-- Blade para select de empresas --}}

@if (isset($Model) && $Model->empresa)

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('empresas', 'Empresa') !!} <br>
    {!! Form::select('empresa_id', $empresas, $Model->empresa->id, ['class' => "form-control select2 ". ( isset($classesExtras) ? $classesExtras : '' )]
    ) !!}
</div>

@else

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('empresas', 'Empresa') !!} <br>
    {!! Form::select('empresa_id', [''=>'']+$empresas, \Request::get('empresa_id'), ['class' => "form-control select2 ". ( isset($classesExtras) ? $classesExtras : ''  ) ]
    ) !!}
</div>

@endif
