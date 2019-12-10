@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('programacoes.index') !!}">Programação</a>
            </li>
            <li class="breadcrumb-item active">Comentários</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 @include('flash::message')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Comentários da programação em {{ $programacao->dataInicioPrevistaFormatada }} da planta {{$programacao->planta->nome}} </strong>

                                 <a href="{!! route('programacoes.show', $programacao->id) !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('programacoes.partials.form_add_comentario')
                                 <div id="container-erros" class="alert alert-danger" style="display:none;"></div>
                                 <hr>
                                 @include('comentarios.table')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
