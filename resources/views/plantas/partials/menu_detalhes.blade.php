<hr>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('plantas.itens', $planta->id) !!}">
        <i class="fa fa-building"></i> &nbsp;
        <span> Gerenciar Itens</span>
    </a>
</div>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('plantas.programacoes', $planta->id) !!}">
        <i class="fa fa-calendar"></i> &nbsp;
        <span> Gerenciar Programações</span>
    </a>
</div>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('plantas.quantidadesMinimas', $planta->id) !!}">
        <i class="fa fa-angle-double-down"></i> &nbsp;
        <span> Quantidade Mínima de Materiais</span>
    </a>
</div>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('plantas.manutencoesCivilEletrica', $planta->id) !!}">
        <i class="fa fa-plug"></i> &nbsp;
        <span> Manutenções Civil/Elétrica</span>
    </a>
</div>

<div class="px-5 py-2">
    <a class="btn btn-primary form-control" href="{!! route('empresas.show', $planta->empresa_id) !!}">
        <i class="fa fa-angle-double-left"></i> &nbsp;
        <span> Voltar</span>
    </a>
</div>

<hr>
