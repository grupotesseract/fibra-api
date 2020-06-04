<section class="row">
    <div class="col-12">
        <table class="table">
            <caption>Documentações Expedidas no Dia</caption>

            <tbody>
                <tr>
                    <td>
                        <form>
                            <div class="wide">
                                <label>IT:</label>
                                {{-- <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly
                                    value="{{$manutencaoCivilEletrica->it}}"
                                /> --}}
                                <p>{{$manutencaoCivilEletrica->it}}</p>
                            </div>

                            @if ($manutencaoCivilEletrica->lem && $manutencaoCivilEletrica->lem !== '')
                                <div class="wide">
                                    <label>LEM:</label>
                                    {{-- <input type="text"
                                        class="form-control form-control-plaintext"
                                        readonly
                                        value="{{$manutencaoCivilEletrica->lem}}"
                                    /> --}}
                                    <p>{{$manutencaoCivilEletrica->lem}}</p>
                                </div>
                            @endif

                            @if ($manutencaoCivilEletrica->let && $manutencaoCivilEletrica->let !== '')
                                <div class="wide">
                                    <label>LET:</label>
                                    {{-- <input type="text"
                                        class="form-control form-control-plaintext"
                                        readonly
                                        value="{{$manutencaoCivilEletrica->let}}"
                                    /> --}}
                                    <p>{{$manutencaoCivilEletrica->let}}</p>
                                </div>
                            @endif

                            @if ($manutencaoCivilEletrica->os && $manutencaoCivilEletrica->os !== '')
                                <div class="wide">
                                    <label>OS:</label>
                                    {{-- <input type="text"
                                        class="form-control form-control-plaintext"
                                        readonly
                                        value="{{$manutencaoCivilEletrica->os}}"
                                    /> --}}
                                    <p>{{$manutencaoCivilEletrica->os}}</p>
                                </div>
                            @endif

                            @if ($manutencaoCivilEletrica->lem && $manutencaoCivilEletrica->lem !== '')
                                <div class="form-inline wide">
                                    <p><b>Início da Liberação LEM:</b> {{! is_null($manutencaoCivilEletrica->data_hora_inicio_lem) ? $manutencaoCivilEletrica->data_hora_inicio_lem->format('H:i') : '    '}}</p>
                                    <p>&nbsp;&nbsp;<b>Término da Liberação:</b> {{! is_null($manutencaoCivilEletrica->data_hora_final_lem) ? $manutencaoCivilEletrica->data_hora_final_lem->format('H:i') : '    '}}</p>
                                </div>
                            @endif

                            @if ($manutencaoCivilEletrica->let && $manutencaoCivilEletrica->let !== '')
                                <div class="form-inline wide">
                                    <p><b>Início da Liberação LET:</b> {{! is_null($manutencaoCivilEletrica->data_hora_inicio_let) ? $manutencaoCivilEletrica->data_hora_inicio_let->format('H:i') : '    '}}</p>
                                    <p>&nbsp;&nbsp;&nbsp;<b>Término da Liberação:</b> {{! is_null($manutencaoCivilEletrica->data_hora_final_let) ? $manutencaoCivilEletrica->data_hora_final_let->format('H:i') : '    '}}</p>
                                </div>
                            @endif

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
