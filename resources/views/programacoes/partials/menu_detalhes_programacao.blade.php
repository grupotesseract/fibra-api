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
    <a class="btn btn-primary form-control" href="{!! route('programacoes.export', $programacao->id) !!}">
        <i class="fa fa-book"></i> &nbsp;
        <span> Relatório Quantidades </span>
    </a>
</div>

<div class="px-5 py-2">
    {!! Form::open(['route' => ['programacoes.relatorioFotos', $programacao->id]]) !!}
    {!! Form::button('<i class="fa fa-download"></i> &nbsp; Relatório Fotográfico', [
        'type' => 'submit',
        'class' => 'btn btn-primary form-control'
    ]) !!}
    {!! Form::close() !!}
</div>
