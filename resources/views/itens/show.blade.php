@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{!! route('itens.index') !!}">Item</a>
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
                                  <a href="{!! route('itens.index') !!}" class="btn btn-ghost-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('itens.show_fields')
                             </div>
                         </div>
                     </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-edit fa-lg"></i>
                            <strong>Materiais do Item</strong>
                        </div>
                        <div class="card-body">
                            @include('itens.partials.form_add_materiais', ['materiais' => [1,2,3]])
                            <hr>
                            @include('itens.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
                 </div>
          </div>
    </div>
@endsection
