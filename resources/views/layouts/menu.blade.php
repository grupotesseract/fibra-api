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
</li>
