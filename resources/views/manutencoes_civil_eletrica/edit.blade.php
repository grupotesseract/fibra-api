@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('manutencoesCivilEletrica.index') !!}">Manutencao Civil Eletrica</a>
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
                              <strong>Edit Manutencao Civil Eletrica</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($manutencaoCivilEletrica, ['route' => ['manutencoesCivilEletrica.update', $manutencaoCivilEletrica->id], 'method' => 'patch']) !!}

                              @include('manutencoes_civil_eletrica.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection