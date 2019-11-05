@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('liberacoesDocumentos.index') !!}">Liberacao Documento</a>
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
                                 <a href="{!! url()->previous() !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('liberacoes_documentos.show_fields')
                             </div>
                         </div>
                     </div>
                     <div class="col-lg-8">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Usuários</strong>
                             </div>
                             <div class="card-body">
                                @include('usuarios.table')
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
