<li class="nav-item {{ Request::is('usuarios*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('usuarios.index') !!}">
        <i class="fa fa-users"></i>
        <span>Usuários</span>
    </a>
</li>
<li class="nav-item {{ Request::is('empresas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('empresas.index') !!}"><i class="fa fa-university"></i><span> Empresas</span></a>

    <li class="nav-item {{ Request::is('plantas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('plantas.index') !!}"><i class="fa fa-map-o"></i><span> Plantas</span></a>
</li>

<li class="nav-item {{ Request::is('tiposMateriais*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('tiposMateriais.index') !!}"><i class="fa fa-book"></i> <span> Tipos de Materiais</span></a>
</li>

<li class="nav-item {{ Request::is('materiais*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('materiais.index') !!}"><i class="fa fa-lightbulb-o"></i><span> Materiais</span></a>
</li>
<li class="nav-item {{ Request::is('potencias*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('potencias.index') !!}">
        <i class="fa fa-battery-full"></i>
        <span> Potências</span>
    </a>
</li>
<li class="nav-item {{ Request::is('tensoes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('tensoes.index') !!}">
        <i class="fa fa-battery-full"></i>
        <span> Tensões</span>
    </a>
<li class="nav-item {{ Request::is('programacoes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('programacoes.index') !!}"><i class="fa fa-calendar"></i><span> Programações</span></a>
<li class="nav-item {{ Request::is('itens*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('itens.index') !!}"><i class="fa fa-building"></i><span> Itens</span></a>
</li>
 {{--
<li class="nav-item {{ Request::is('liberacoesDocumentos*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('liberacoesDocumentos.index') !!}">
        <i class="fa fa-clock-o"></i>
        <span> Liberações de Documentos</span>
    </a>
</li>
<li class="nav-item {{ Request::is('usuariosLiberacoes*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('usuariosLiberacoes.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Liberações de Documentos Usuários</span>

<li class="nav-item {{ Request::is('quantidadesMinimas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('quantidadesMinimas.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Quantidades Minimas</span>
    </a>
</li>
<li class="nav-item {{ Request::is('estoque*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('estoque.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Estoque</span>
    </a>
</li>
<li class="nav-item {{ Request::is('quantidadesSubstituidas*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('quantidadesSubstituidas.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Quantidades Substituidas</span>
    </a>
</li>
<li class="nav-item {{ Request::is('entradasMateriais*') ? 'active' : '' }}">
    <a class="nav-link" href="{!! route('entradasMateriais.index') !!}">
        <i class="nav-icon icon-cursor"></i>
        <span>Entradas Materiais</span>
    </a>
</li>
 --}}
