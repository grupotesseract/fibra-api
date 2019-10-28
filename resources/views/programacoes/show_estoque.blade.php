@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('programacoes.index') !!}">Programação</a>
            </li>
            <li class="breadcrumb-item active">Estoque</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 @include('flash::message')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Estoque da programação em {{ $programacao->dataInicioPrevistaFormatada }} </strong>
                                 <a href="{!! route('programacoes.show', $programacao->id) !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('programacoes.partials.form_add_estoque')
                                 <div id="container-erros" class="alert alert-danger" style="display:none;"></div>
                                 <hr>
                                 @include('estoque.table')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
