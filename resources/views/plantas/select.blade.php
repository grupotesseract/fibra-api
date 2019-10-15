{{-- Blade para select de plantas  --}}

@if (isset($Model) && $Model->planta)

@include('empresas.select', [
    'Model' => $Model->planta,
    'classesExtras' => 'select-plantas-empresa'
])

<!-- Select de Plantas  -->
<div class="form-group">
    {!! Form::label('plantas', 'Planta') !!} <br>
    {!! Form::select('planta_id', $plantas, $Model->planta->id, ['class' =>"form-control select-plantas select2 ".($classesExtras ?? '') ]
    ) !!}
</div>

@else

@include('empresas.select', [
    'classesExtras' => 'select-plantas-empresa'
])

<!-- Select de Plantas  -->
<div class="form-group">
    {!! Form::label('plantas', 'Planta') !!} <br>
    {!! Form::select('planta_id', [''=>'']+$plantas, null, ['class' =>"form-control select-plantas select2 ". ($classesExtras ?? '') ]
    ) !!}
</div>

@endif

@section('scripts')
    <script src="/js/pages/Plantas.js"></script>
@append
