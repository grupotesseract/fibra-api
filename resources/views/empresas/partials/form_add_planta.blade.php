{!! Form::open(['route' => ['entradasMateriais.store'], 'id' => 'form-add-entrada-material']) !!}

{!! Form::hidden('programacao_id', $programacao->id, ['id' => 'programacao_id']) !!}

<div class="row">

    <!-- Select Materiais -->
    <div class="form-group col-sm-6">
        {!! Form::label('material', 'Material') !!}
        {!! Form::select('material_id', [0=>'Selecione um Material']+$materiais, null, ['class' => 'form-control  select2', 'id' => 'material_id']
        ) !!}
    </div>

    <!-- Quantidade Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('quantidade', 'Quantidade') !!}
        {!! Form::number('quantidade', null, ['class' => 'form-control', 'id' => 'quantidade']) !!}
    </div>

    <div class="form-group col-sm-2">
        {!! Form::button('<i class="fa fa-plus"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-success mt-4',
        ]) !!}
    </div>
</div>
{{ Form::close() }}


@section('scripts')
    <script src="/js/pages/EntradaMateriais.js"></script>
@append

