{!! Form::open(['route' => ['programacoes.addQuantidadesSubstituidas', $programacao->id], 'id' => 'form-add-quantidades-substituidas']) !!}

{!! Form::hidden('programacao_id', $programacao->id, ['id' => 'programacao_id']) !!}

<div class="row">

    <!-- Select Materiais -->
    <div class="form-group col-sm-3">
        {!! Form::label('item', 'Item') !!}
        {!! Form::select('item_id', [0=>'Selecione um Item']+$itens, null, ['class' => 'form-control  select2', 'id' => 'item_id']
        ) !!}
    </div>

    <!-- Select Materiais -->
    <div class="form-group col-sm-4">
        {!! Form::label('material', 'Material') !!}
        {!! Form::select('material_id', [0=>'Selecione um Material']+$materiais, null, ['class' => 'form-control  select2', 'id' => 'material_id']
        ) !!}
    </div>

    <!-- Quantidade Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('quantidade', 'Qnt. substituída') !!}
        {!! Form::number('quantidade', null, ['class' => 'form-control', 'id' => 'quantidade']) !!}
    </div>

    <!-- Select Bases -->
    <div class="form-group col-sm-3">
        @include('materiais.select_bases')
    </div>

    <!-- Quantidade Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('quantidade_substituida_base', 'Qnt. substituída Base') !!}
        {!! Form::number('quantidade_substituida_base', null, ['class' => 'form-control', 'id' => 'quantidade_substituida_base']) !!}
    </div>

    <!-- Select Materiais -->
    <div class="form-group col-sm-3">
        @include('materiais.select_reatores')
    </div>

    <!-- Quantidade Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('quantidade_substituida_reator', 'Qnt. substituída Reator') !!}
        {!! Form::number('quantidade_substituida_reator', null, ['class' => 'form-control', 'id' => 'quantidade_substituida_reator']) !!}
    </div>

    


    <div class="form-group col-sm-1">
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

