@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('manutencoesCivilEletrica.index') }}">Manutenção Civil Elétrica</a>
            </li>
            <li class="breadcrumb-item active">Detalhes</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Detalhes</strong>
                                  <a href="{{ route('manutencoesCivilEletrica.index') }}" class="btn btn-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('manutencoes_civil_eletrica.show_fields')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
