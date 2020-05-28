<section class="row">
    <div class="col-12">
        <table class="table">
            <caption>Documentações Expedidas no Dia</caption>

            <tbody>
                <tr>
                    <td>
                        <form>
                            <div class="form-inline wide">
                                <label>IT:</label>
                                {{-- <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly                                    
                                    value="{{$manutencaoCivilEletrica->it}}"                                    
                                /> --}}
                                <p>{{$manutencaoCivilEletrica->it}}</p>
                            </div>

                            <div class="form-inline wide">
                                <label>LEM:</label>
                                {{-- <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly
                                    value="{{$manutencaoCivilEletrica->lem}}"
                                /> --}}
                                <p>{{$manutencaoCivilEletrica->lem}}</p>
                            </div>

                            <div class="form-inline wide">
                                <label>LET:</label>
                                {{-- <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly
                                    value="{{$manutencaoCivilEletrica->let}}"
                                /> --}}
                                <p>{{$manutencaoCivilEletrica->let}}</p>
                            </div>

                            <div class="form-inline wide">
                                <label>OS:</label>
                                {{-- <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly                                    
                                    value="{{$manutencaoCivilEletrica->os}}"
                                /> --}}
                                <p>{{$manutencaoCivilEletrica->os}}</p>
                            </div>

                            <div class="form-inline wide">
                                <p><b>Início da Liberação LEM:</b> {{! is_null($manutencaoCivilEletrica->data_hora_inicio_lem) ? $manutencaoCivilEletrica->data_hora_inicio_lem->format('H:i') : '    '}}</p>
                                <p>&nbsp;&nbsp;<b>Término da Liberação:</b> {{! is_null($manutencaoCivilEletrica->data_hora_final_lem) ? $manutencaoCivilEletrica->data_hora_final_lem->format('H:i') : '    '}}</p>
                            </div>

                            <div class="form-inline wide">
                                <p><b>Início da Liberação LET:</b> {{! is_null($manutencaoCivilEletrica->data_hora_inicio_let) ? $manutencaoCivilEletrica->data_hora_inicio_let->format('H:i') : '    '}}</p>
                                <p>&nbsp;&nbsp;&nbsp;<b>Término da Liberação:</b> {{! is_null($manutencaoCivilEletrica->data_hora_final_let) ? $manutencaoCivilEletrica->data_hora_final_let->format('H:i') : '    '}}</p>
                            </div>

                            <div class="form-inline">
                                <p><b>Início da Atividade:</b> {{! is_null($manutencaoCivilEletrica->data_hora_inicio_atividades) ? $manutencaoCivilEletrica->data_hora_inicio_atividades->format('H:i') : '    '}}</p>
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
