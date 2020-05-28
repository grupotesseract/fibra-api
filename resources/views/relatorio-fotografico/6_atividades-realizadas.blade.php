<section class="row">
    <div class="col-12">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="text-uppercase col">Atividades Realizadas no Dia</th>
                    <th>
                        Status<br>
                        {{-- <small>Em Andamento<br>
                        ou Concluída</small> --}}
                    </th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($manutencaoCivilEletrica->atividadesRealizadas as $atividadeRealizada)
                
                    <tr>
                        <td>{{$atividadeRealizada->texto}}</td>
                        <td class="text-center">
                            <span class="badge badge-{{$atividadeRealizada->status ? 'success' : 'warning'}}">{{$atividadeRealizada->status ? 'CONCLUÍDA' : 'EM ANDAMENTO'}}</span>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</section>
