{{-- Blade para select de Materiais - campo Reator  --}}

@if (isset($Model) && $Model->reator)

<!-- Select de Materiais  -->
<div class="form-group">
    {!! Form::label('materiais', 'Reator') !!} <br>
    {!! Form::select('reator_id', [null => 'Selecionar'] + $materiais, $Model->reator->id, ['class' =>"form-control select2 ".($classesExtras ?? '') ]
    ) !!}
</div>

@else

<!-- Select de Plantas  -->
<div class="form-group">
    {!! Form::label('materiais', 'Reator') !!} <br>
    {!! Form::select('reator_id', [''=>'']+$materiais, null, ['class' =>"form-control select2 ". ($classesExtras ?? '') ]
    ) !!}
</div>

@endif