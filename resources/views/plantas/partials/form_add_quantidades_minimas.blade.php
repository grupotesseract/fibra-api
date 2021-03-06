{!! Form::open(['route' => ['plantas.addQuantidadesMinimas', $planta->id], 'id' => 'form-quantidades-minimas']) !!}
<div class="row">

    <!-- Select Materiais -->
    <div class="form-group col-sm-6">
        {!! Form::label('material', 'Material') !!}
        {!! Form::select('material_id', [0=>'Selecione um Material']+$materiais, null, ['class' => 'form-control  select2', 'id' => 'material_id']
        ) !!}
    </div>

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('quantidade_minima', 'Quantidade mínima') !!}
        {!! Form::number('quantidade_minima', null, ['class' => 'form-control', 'id' => 'qnt_minima']) !!}
    </div>

    {{ Form::hidden('planta_id', $planta->id, ['id' => 'planta_id']) }}

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-2">
        {!! Form::button('<i class="fa fa-plus"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-success mt-4',
        ]) !!}
    </div>
</div>
{{ Form::close() }}


@section('scripts')
    <script src="/js/pages/QuantidadesMinimas.js"></script>
@endsection

