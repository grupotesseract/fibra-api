<div class="col-xs-12">
    {!! Form::open(['route' => ['comentarios.store'], 'id' => 'form-add-comentario']) !!}

    {!! Form::hidden('programacao_id', $programacao->id, ['id' => 'programacao_id']) !!}

    <div class="row">

        <!-- Item Materiais -->
        <div class="form-group col-sm-3">
            {!! Form::label('item', 'Item') !!}
            {!! Form::select('item_id', [0=>'Selecione um Item']+$programacao->planta->itens()->pluck('nome', 'id')->all(), null, ['class' => 'form-control  select2', 'id' => 'item_id']
            ) !!}
        </div>

        <!-- Quantidade Field -->
        <div class="form-group col-sm-8">
            {!! Form::label('comentario', 'Comentário') !!}
            {!! Form::textarea('comentario', null, ['class' => 'form-control', 'id' => 'comentario', 'rows'=>2]) !!}
        </div>

        <div class="form-group col-sm-1">
            {!! Form::button('<i class="fa fa-plus"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-success mt-4',
            ]) !!}
        </div>
    </div>
    {{ Form::close() }}
</div>


@section('scripts')
    <script src="/js/pages/Comentarios.js"></script>
@append

