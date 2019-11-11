{{-- Blade para select de cidades --}}

@if (isset($Model) && $Model->tipoMaterial)

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('tipos_materiais', 'Tipo de Material') !!} <br>
    {!! Form::select('tipo_material_id', $tipos_materiais, $Model->tipoMaterial->id, ['class' => 'form-control tipoMaterial select2']
    ) !!}
</div>

@else

<!-- Select de empresas  -->
<div class="form-group">
    {!! Form::label('tipos_materiais', 'Tipo de Material') !!} <br>
    {!! Form::select('tipo_material_id', [''=>'']+$tipos_materiais, null, ['class' => 'form-control tipoMaterial select2']
    ) !!}
</div>

@endif
