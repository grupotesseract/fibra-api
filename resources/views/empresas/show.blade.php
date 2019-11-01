@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('empresas.index') !!}">Empresa</a>
            </li>
            <li class="breadcrumb-item active">Detalhes</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 <div class="row">
                     <div class="col-lg-4">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Detalhes</strong>
                                  <a href="{!! route('empresas.index') !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('empresas.show_fields')
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-8">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Plantas</strong>
                             </div>
                             <div class="card-body">
                                 @include('plantas.table')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
