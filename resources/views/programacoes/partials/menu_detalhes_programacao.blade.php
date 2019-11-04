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
