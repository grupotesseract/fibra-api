@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('plantas.index') !!}">Planta</a>
        </li>
        <li class="breadcrumb-item active">Detalhes</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            @include('flash::message')
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Detalhes</strong>
                            <a href="{!! route('empresas.show', $planta->empresa_id) !!}" class="btn btn-ghost-light">Voltar</a>
                        </div>
                        <div class="card-body">
                            @include('plantas.show_fields')
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Itens da planta {{$planta->nome}}</strong>
                        </div>
                        <div class="card-body">
                            <div class="px-5 py-2">
                                <a class="btn btn-primary form-control" href="{!! route('itens.create', ['planta_id' => $planta->id, 'empresa_id' => $planta->empresa_id]) !!}">
                                    <i class="fa fa-plus"></i> &nbsp;
                                    <span> Adicionar Item </span>
                                </a>
                            </div>

                            <hr>

                            @include('itens.table')
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
