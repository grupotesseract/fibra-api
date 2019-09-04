<li class="nav-item {{ Request::is('usuarios*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('usuarios.index') !!}"><i class="fa fa-users"></i> &nbsp; <span>Usuários</span></a>
</li>

<li class="nav-item {{ Request::is('tiposMateriais*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('tiposMateriais.index') !!}"><i class="fa fa-book"></i> &nbsp; <span>Tipos de Materiais</span></a>
</li>