<li class="nav-item {{ Request::is('usuarios*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('usuarios.index') !!}"><i class="fa fa-users"></i> &nbsp; <span>Usuários</span></a>
</li>

<li class="nav-item {{ Request::is('empresas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('empresas.index') !!}"><i class="nav-icon icon-cursor"></i><span>Empresas</span></a>