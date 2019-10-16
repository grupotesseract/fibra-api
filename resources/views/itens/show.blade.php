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
                                  <a href="{!! route('itens.index') !!}" class="btn btn-ghost-light">Voltar</a>
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
                            @include('itens.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
                 </div>
          </div>
    </div>
@endsection
