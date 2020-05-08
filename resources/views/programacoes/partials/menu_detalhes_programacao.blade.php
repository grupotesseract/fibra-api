<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.itensAlterados', $programacao->id) !!}">
        <i class="fa fa-lightbulb-o"></i> &nbsp;
        <span> Itens Alterados</span>
    </a>
</div>
<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.liberacoesDocumentos', $programacao->id) !!}">
        <i class="fa fa-clock-o"></i> &nbsp;
        <span> Liberações de Documentos</span>
    </a>
</div>
<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.estoque', $programacao->id) !!}">
        <i class="fa fa-cubes"></i> &nbsp;
        <span> Gerenciar Estoque </span>
    </a>
</div>
<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.entradasMateriais', $programacao->id) !!}">
        <i class="fa fa-lightbulb-o"></i> &nbsp;
        <span> Entradas de Materiais </span>
    </a>
</div>
<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.quantidadesSubstituidas', $programacao->id) !!}">
        <i class="fa fa-refresh"></i> &nbsp;
        <span> Quantidades Substituídas </span>
    </a>
</div>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.comentarios', $programacao->id) !!}">
        <i class="fa fa-comments"></i> &nbsp;
        <span> Comentários </span>
    </a>
</div>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.datasManutencoes', $programacao->id) !!}">
        <i class="fa fa-clock-o"></i> &nbsp;
        <span> Datas e Horários </span>
    </a>
</div>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.comentariosGerais', $programacao->id) !!}">
        <i class="fa fa-comments-o"></i> &nbsp;
        <span> Comentários Gerais</span>
    </a>
</div>

<div class="px-5 py-2">
    {!! Form::open(['route' => ['programacoes.relatorioQuantidade', $programacao->id], 'id' => 'download-relatorio-quantidades']) !!}
    {!! Form::button('<i class="fa fa-book"></i> &nbsp; Relatório Quantidades ', [
        'type' => 'submit',
        'class' => 'btn btn-primary form-control'
    ]) !!}
    {!! Form::close() !!}
</div>

<div class="px-5 py-2">
    {!! Form::open(['route' => ['programacoes.relatorioFotos', $programacao->id], 'id' => 'download-relatorio-fotografico']) !!}
    {!! Form::button('<i class="fa fa-download"></i> &nbsp; Relatório Fotográfico', [
        'type' => 'submit',
        'class' => 'btn btn-primary form-control'
    ]) !!}
    {!! Form::close() !!}
</div>

{{-- <div class="px-5 py-2">
    {!! Form::open(['route' => ['programacoes.deleteRelatorioFotos', $programacao->id], 'id' => 'download-relatorio-fotografico']) !!}
    {!! Form::button('<i class="fa fa-download"></i> &nbsp; Excluir Relatório Fotográfico', [
        'type' => 'submit',
        'class' => 'btn btn-primary form-control'
    ]) !!}
    {!! Form::close() !!}
</div> --}}

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.deleteRelatorioFotos', $programacao->id) !!}">
        <i class="fa fa-angle-double-left"></i> &nbsp;
        <span> Excluir Relatório Fotográfico</span>
    </a>
</div>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('programacoes.deleteRelatorioQuantidades', $programacao->id) !!}">
        <i class="fa fa-angle-double-left"></i> &nbsp;
        <span> Excluir Relatório de Quantidades</span>
    </a>
</div>


<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('plantas.programacoes', $programacao->planta_id) !!}">
        <i class="fa fa-angle-double-left"></i> &nbsp;
        <span> Voltar</span>
    </a>
</div>


@section('scripts')
    <script src="/js/pages/Programacao.js"></script>
@append


