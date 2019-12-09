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
                            
                            <div class="px-5 py-2">    
                                <a class="btn btn-primary form-control" href="{!! url()->previous() !!}">
                                    <i class="fa fa-angle-double-left"></i> &nbsp;
                                    <span> Voltar</span>
                                </a>
                            </div>

                            <div class="px-5 py-2">    
                                <a class="btn btn-primary form-control" href="{!! route('plantas.show', $item->planta->id) !!}">
                                    <i class="fa fa-angle-double-left"></i> &nbsp;
                                    <span> Acessar Planta</span>
                                </a>
                            </div>

                            <div class="px-5 py-2">    
                                <a class="btn btn-primary form-control" href="{!! route('plantas.itens', $item->planta->id) !!}">
                                    <i class="fa fa-angle-double-left"></i> &nbsp;
                                    <span> Acessar Itens da Planta</span>
                                </a>
                            </div>
                            
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
