{!! Form::open(['route' => ['itens.associarMaterial', $item->id], 'id' => 'form-associar-materiais']) !!}
<div class="row">

    <!-- Select Materiais -->
    <div class="form-group col-sm-6">
        {!! Form::label('material', 'Material') !!}
        {!! Form::select('material_id', [0=>'Selecione um Material']+$materiais, null, ['class' => 'form-control  select2', 'id' => 'material_id']
        ) !!}
    </div>

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('quantidade_instalada', 'Quantidade instalada') !!}
        {!! Form::number('quantidade_instalada', null, ['class' => 'form-control', 'id' => 'qnt_instalada']) !!}
    </div>

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
    <script src="/js/pages/MateriaisItem.js"></script>
@endsection

