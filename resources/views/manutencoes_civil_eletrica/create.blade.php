@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
         <a href="{!! route('manutencoesCivilEletrica.index') !!}">Manutencao Civil Eletrica</a>
      </li>
      <li class="breadcrumb-item active">Create</li>
    </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-plus-square-o fa-lg"></i>
                                <strong>Create Manutencao Civil Eletrica</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'manutencoesCivilEletrica.store']) !!}

                                   @include('manutencoes_civil_eletrica.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
