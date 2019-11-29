@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('itens.index') !!}">Item</a>
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
                            <a href="{!! url()->previous() !!}" class="btn btn-primary">Voltar</a>
                            <a href="{!! route('plantas.show', $item->planta->id) !!}" class="btn btn-primary">Acessar Planta</a>
                            <a href="{!! route('plantas.itens', $item->planta->id) !!}" class="btn btn-primary">Acessar Itens da Planta</a>
                        </div>
                        <div class="card-body">
                            @include('itens.show_fields')
                        </div>
                        
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Materiais do Item</strong>
                        </div>
                        <div class="card-body">
                            @include('itens.partials.form_add_materiais')
                            <div id="container-erros" class="alert alert-danger" style="display:none;"></div>
                            <hr>
                            @include('materiais.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
