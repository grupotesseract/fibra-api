{{-- Blade para select de estados --}}

@if (isset($Model) && $Model->cidade)

<!-- Select de Estados  -->
<div class="form-group">
    {!! Form::label('estados', 'Estado') !!} <br>
    {!! Form::select('estado_id', $estados, $Model->cidade->estado->id, ['class' => 'form-control select-estados']
    ) !!}
</div>

@else

<!-- Select de Estados  -->
<div class="form-group">
    {!! Form::label('estados', 'Estado') !!} <br>
    {!! Form::select('estado_id', [''=>'']+$estados, null, ['class' => 'form-control select-estados']
    ) !!}
</div>
@endif

@section('scripts')
    <script src="/js/ajax-cidades.js"></script>
@endsection