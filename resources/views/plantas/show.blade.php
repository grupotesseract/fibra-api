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
                        </div>
                        <div class="card-body">
                            @include('plantas.show_fields')
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Outras informações da planta {{$planta->nome}}</strong>
                        </div>
                        <div class="card-body">
                            @include('plantas.partials.menu_detalhes')
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
