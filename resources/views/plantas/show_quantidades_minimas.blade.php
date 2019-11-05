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
                            <a href="{!! route('plantas.show', $planta->id) !!}" class="btn btn-ghost-light">Voltar</a>
                        </div>
                        <div class="card-body">
                            @include('plantas.show_fields')
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Quantidades mínimas da planta {{$planta->nome}}</strong>
                        </div>
                        <div class="card-body">

                            @include('plantas.partials.form_add_quantidades_minimas')
                            <div id="container-erros" class="alert alert-danger" style="display:none;"></div>

                            <hr>

                            @include('quantidades_minimas.table')
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
