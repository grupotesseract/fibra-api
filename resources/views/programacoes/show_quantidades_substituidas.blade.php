@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('programacoes.index') !!}">Programação</a>
            </li>
            <li class="breadcrumb-item active">Quantidades substituídas</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 @include('flash::message')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Quantidades substituídas da programação em {{ $programacao->dataInicioPrevistaFormatada }} da planta {{$programacao->planta->nome}} </strong>

                                 <a href="{!! route('programacoes.show', $programacao->id) !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('programacoes.partials.form_quantidades_substituidas')
                                 <div id="container-erros" class="alert alert-danger" style="display:none;"></div>
                                 <hr>
                                 @include('quantidades_substituidas.table')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
