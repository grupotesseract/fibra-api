<section class="row">
    <div class="col-12">
        <table class="table text-center">
            <caption>Equipe Fibra Engenharia</caption>

            <thead>
                <th class="text-uppercase col">Colaborador</th>
                <th>Entrada</th>
                <th>Saída</th>
                <th>Entrada</th>
                <th>Saída</th>
            </thead>

            <tbody>

                @foreach ($manutencaoCivilEletrica->usuarios()->with('usuario')->get()->pluck('usuario.nome')->toArray() as $equipe)
                    <tr>
                        <td class="text-left">{{$equipe}}</td>
                        <td>{{! is_null($manutencaoCivilEletrica->data_hora_entrada) ? $manutencaoCivilEletrica->data_hora_entrada->format('H:i') : ''}}</td>
                        <td>12:00</td>
                        <td>13:00</td>
                        <td>{{! is_null($manutencaoCivilEletrica->data_hora_saida) ? $manutencaoCivilEletrica->data_hora_saida->format('H:i') : ''}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</section>
