@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('itens.show', $item->id) !!}">Item</a>
        </li>
        <li class="breadcrumb-item active">Materiais</li>
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
                            <a href="{!! url()->previous() !!}" class="btn btn-ghost-light">Voltar</a>
                        </div>
                        <div class="card-body">
                            @include('itens.show_fields')
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Editando quantidade do material</strong>
                        </div>
                        <div class="card-body">
                            @include('itens.partials.form_edit_material')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
