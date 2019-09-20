{{-- Blade para select de Materiais - campo Receptaculo  --}}

@if (isset($Model) && $Model->receptaculo)

<!-- Select de Materiais  -->
<div class="form-group">
    {!! Form::label('materiais', 'Receptaculo') !!} <br>
    {!! Form::select('receptaculo_id', $materiais, $Model->receptaculo->id, ['class' =>"form-control select2 ".($classesExtras ?? '') ]
    ) !!}
</div>

@else

<!-- Select de Plantas  -->
<div class="form-group">
    {!! Form::label('materiais', 'Receptáculo') !!} <br>
    {!! Form::select('receptaculo_id', [''=>'']+$materiais, null, ['class' =>"form-control select2 ". ($classesExtras ?? '') ]
    ) !!}
</div>

@endif