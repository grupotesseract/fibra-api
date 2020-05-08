@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('programacoes.index') !!}">Programação</a>
            </li>
            <li class="breadcrumb-item active">Itens Alterados</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Itens Alterados da programação em {{ $programacao->dataInicioRealFormatada }} - {{ $programacao->dataInicioRealFormatada }}</strong>
                                     <br>
                                     <strong>Planta: {{ $programacao->planta->nome }}</strong>
                                 <a href="{!! route('programacoes.show', $programacao->id) !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('itens_alterados.table')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
