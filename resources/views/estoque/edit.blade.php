@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('estoque.index') !!}">Estoque</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Estoque do material {{ $estoque->material->nomePotenciaTensao }} da programacao em {{ $estoque->programacao->dataInicioPrevistaFormatada}}</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($estoque, ['route' => ['estoque.update', $estoque->id], 'method' => 'patch']) !!}

                              @include('estoque.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
