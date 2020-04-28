@extends('layouts.app')

@section('content')
     <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{!! route('plantas.manutencoesCivilEletrica', $manutencaoCivilEletrica->planta_id) !!}">Manutencao Civil/Elétrica</a>
            </li>
            <li class="breadcrumb-item active">Detalhes</li>
     </ol>
     <div class="container-fluid">
          <div class="animated fadeIn">
                 @include('coreui-templates::common.errors')
                 @include('flash::message')
                 <div class="row">
                     <div class="col-lg-4">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Detalhes</strong>
                                  <a href="{!! route('plantas.manutencoesCivilEletrica', $manutencaoCivilEletrica->planta_id) !!}" class="btn btn-light">Voltar</a>
                             </div>
                             <div class="card-body">
                                 @include('manutencoes_civil_eletrica.show_fields')
                             </div>
                         </div>
                     </div>

                     <div class="col-lg-8">
                         <div class="card">
                             <div class="card-header">
                                 <strong>Atividades Realizadas na Manutenção Civil/Elétrica</strong>
                             </div>
                             <div class="card-body">
                                 <div class="px-5 py-2">
                                     <a class="btn btn-primary form-control" href="{!! route('atividadesRealizadas.create', ['manutencao_id' => $manutencaoCivilEletrica->id]) !!}">
                                         <i class="fa fa-plus"></i> &nbsp;
                                         <span> Adicionar Atividade Realizada</span>
                                     </a>
                                 </div>
                                 <div class="px-5 py-2">
                                     <a class="btn btn-primary form-control" href="{!! route('plantas.manutencoesCivilEletrica', $manutencaoCivilEletrica->planta_id) !!}">
                                         <i class="fa fa-angle-double-left"></i> &nbsp;
                                         <span> Voltar</span>
                                     </a>
                                 </div>

                                 <hr>

                                 @include('manutencoes_civil_eletrica.table')

                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
