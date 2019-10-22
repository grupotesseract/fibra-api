@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('programacoes.index') !!}">Programação</a>
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
                                  <a href="{!! route('programacoes.index') !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('programacoes.show_fields')
                             </div>
                         </div>
                     </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Outras informações</strong>
                        </div>
                        <div class="card-body">
                            @include('programacoes.partials.menu_detalhes_programacao')

                        </div>
                    </div>
                </div>
                 </div>
          </div>
    </div>
@endsection
