<div class="col-xs-12">
    {!! Form::open(['route' => ['programacoes.comentariosGerais', $programacao->id], 'id' => 'form-add-comentario-geral']) !!}

    {!! Form::hidden('programacao_id', $programacao->id, ['id' => 'programacao_id']) !!}

    <div class="row">

        <!-- Quantidade Field -->
        <div class="form-group col-sm-11">
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
    <script src="/js/pages/ComentariosGerais.js"></script>
@append

