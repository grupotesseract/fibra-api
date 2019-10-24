{!! Form::open(['route' => ['estoque.store'], 'id' => 'form-add-estoque']) !!}

{!! Form::hidden('programacao_id', $programacao->id) !!}

<div class="row">

    <!-- Select Materiais -->
    <div class="form-group col-sm-3">
        {!! Form::label('material', 'Material') !!}
        {!! Form::select('material_id', [0=>'Selecione um Material']+$materiais, null, ['class' => 'form-control  select2', 'id' => 'material_id']
        ) !!}
    </div>

    <!-- Quantidade Inicial Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('quantidade_inicial', 'Quantidade inicial') !!}
        {!! Form::number('quantidade_inicial', null, ['class' => 'form-control', 'id' => 'qnt_inicial']) !!}
    </div>

    <!-- Quantidade Final Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('quantidade_final', 'Quantidade final') !!}
        {!! Form::number('quantidade_final', null, ['class' => 'form-control', 'id' => 'qnt_final']) !!}
    </div>

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-3">
        {!! Form::button('<i class="fa fa-plus"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-success mt-4',
        ]) !!}
    </div>
</div>
{{ Form::close() }}


@section('scripts')
    <script src="/js/pages/MateriaisItem.js"></script>
@append

