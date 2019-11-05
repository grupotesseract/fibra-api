{!! Form::open(['route' => ['quantidadesSubstituidas.store'], 'id' => 'form-add-quantidades-substituidas']) !!}

{!! Form::hidden('programacao_id', $programacao->id, ['id' => 'programacao_id']) !!}
{!! Form::hidden('item_id', $programacao->item_id, ['id' => 'item_id']) !!}

<div class="row">

    <!-- Select Materiais -->
    <div class="form-group col-sm-6">
        {!! Form::label('material', 'Material') !!}
        {!! Form::select('material_id', [0=>'Selecione um Material']+$materiais, null, ['class' => 'form-control  select2', 'id' => 'material_id']
        ) !!}
    </div>

    <!-- Quantidade Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('quantidade', 'Quantidade substituída') !!}
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
    <script src="/js/pages/QuantidadesSubstituidas.js"></script>
@append

