@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('programacoes.index') !!}">Programação</a>
            </li>
            <li class="breadcrumb-item active">Entradas de materiais</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 @include('flash::message')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Entradas de materiais da programação em {{ $programacao->dataInicioPrevistaFormatada }} </strong>
                                 <a href="{!! route('programacoes.show', $programacao->id) !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('programacoes.partials.form_add_entrada_material')
                                 <div id="container-erros" class="alert alert-danger" style="display:none;"></div>
                                 <hr>
                                 @include('entradas_materiais.table')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
