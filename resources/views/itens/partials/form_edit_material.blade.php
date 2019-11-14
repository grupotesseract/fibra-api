{!! Form::open(['route' => ['itens.materiais.update', $item->id, $idMaterial], 'id' => 'form-edit-qnt-materiais', 'method' => 'put']) !!}
<div class="row">

    <!-- Select Materiais -->
    <div class="form-group col-sm-6">
        {!! Form::label('material', 'Material') !!}
        {!! Form::select('select_material', [0=>'Selecione um Material']+$materiais, $idMaterial, ['class' => 'form-control  select2', 'id' => 'select_material', 'disabled']) !!}
        {!! Form::hidden('material_id', $idMaterial) !!}
    </div>

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('quantidade_instalada', 'Quantidade instalada') !!}
        {!! Form::number('quantidade_instalada', $qntInstalada, ['class' => 'form-control', 'id' => 'qnt_instalada']) !!}
    </div>

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-2">
        {!! Form::button('<i class="fa fa-check"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-success mt-4',
        ]) !!}
    </div>
</div>
{{ Form::close() }}


@section('scripts')
    <script src="/js/pages/MateriaisItem.js"></script>
@endsection

