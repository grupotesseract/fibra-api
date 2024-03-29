{{-- Blade para select de Materiais - campo base  --}}

@if (isset($Model) && $Model->base)

<!-- Select de Materiais  -->
<div class="form-group">
    {!! Form::label('materiais', 'Base') !!} <br>
    {!! Form::select('base_id', [null => 'Selecionar'] + $materiais, $Model->base->id, ['class' =>"form-control select2 ".($classesExtras ?? '') ]
    ) !!}
</div>

@else

<!-- Select de Plantas  -->
<div class="form-group">
    {!! Form::label('materiais', 'Base') !!} <br>
    {!! Form::select('base_id', [''=>'']+$materiais, null, ['id' => 'base_id', 'class' =>"form-control select2 ". ($classesExtras ?? '') ]
    ) !!}
</div>

@endif