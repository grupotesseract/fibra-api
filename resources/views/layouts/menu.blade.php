<li class="nav-item {{ Request::is('usuarios*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('usuarios.index') !!}"><i class="fa fa-users"></i> &nbsp; <span>Usuários</span></a>
</li>

<li class="nav-item {{ Request::is('empresas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('empresas.index') !!}"><i class="fa fa-university"></i> &nbsp; <span>Empresas</span></a>

    <li class="nav-item {{ Request::is('plantas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('plantas.index') !!}"><i class="fa fa-map-o"></i> &nbsp; <span>Plantas</span></a>
</li>

<li class="nav-item {{ Request::is('tiposMateriais*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('tiposMateriais.index') !!}"><i class="fa fa-book"></i> &nbsp; <span>Tipos de Materiais</span></a>
</li>

<li class="nav-item {{ Request::is('materiais*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('materiais.index') !!}"><i class="fa fa-lightbulb-o"></i> &nbsp;  &nbsp;<span>Materiais</span></a>
</li>
<li class="nav-item {{ Request::is('potencias*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('potencias.index') !!}">
        <i class="fa fa-battery-full"></i>&nbsp;
        <span>Potências</span>
    </a>
</li>
<li class="nav-item {{ Request::is('tensoes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('tensoes.index') !!}">
        <i class="fa fa-battery-full"></i>&nbsp;
        <span>Tensões</span>
    </a>
<li class="nav-item {{ Request::is('programacoes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('programacoes.index') !!}"><i class="fa fa-calendar"></i> &nbsp; <span>Programações</span></a>
<li class="nav-item {{ Request::is('itens*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('itens.index') !!}"><i class="fa fa-building"></i> &nbsp; <span>Itens</span></a>
</li>
<li class="nav-item {{ Request::is('liberacoesDocumentos*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('liberacoesDocumentos.index') !!}">
        <i class="fa fa-clock-o"></i>
        &nbsp; <span>Liberações de Documentos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('usuariosLiberacoes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('usuariosLiberacoes.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Liberações de Documentos Usuários</span>
    </a>
</li>
