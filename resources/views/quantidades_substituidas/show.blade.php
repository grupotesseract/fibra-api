@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('programacoes.quantidadesSubstituidas', $quantidadeSubstituida->programacao_id) !!}">Quantidade Substituida</a>
            </li>
            <li class="breadcrumb-item active">Detalhe</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Detalhes</strong>
                             </div>
                             <div class="card-body">
                                 @include('quantidades_substituidas.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
