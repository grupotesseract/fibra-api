<section class="row">
    <div class="col-12">
        <table class="table">
            <caption>Documentações Expedidas no Dia</caption>

            <tbody>
                <tr>
                    <td>
                        <form>
                            <div class="form-inline">
                                <label>IT:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly
                                    value="{{$manutencaoCivilEletrica->it}}"
                                />
                            </div>

                            <div class="form-inline">
                                <label>LEM:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly
                                    value="{{$manutencaoCivilEletrica->lem}}"
                                />
                            </div>

                            <div class="form-inline">
                                <label>LET:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly
                                    value="{{$manutencaoCivilEletrica->let}}"
                                />
                            </div>

                            <div class="form-inline">
                                <label>OS:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    readonly
                                    value="{{$manutencaoCivilEletrica->os}}"
                                />
                            </div>

                            <div class="form-inline wide">
                                <label>Início da Liberação LEM:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    size="1"
                                    readonly
                                    value="{{! is_null($manutencaoCivilEletrica->data_hora_inicio_lem) ? $manutencaoCivilEletrica->data_hora_inicio_lem->format('H:i') : '    '}}"

                                />                                

                                <label>Término da Liberação:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    size="1"
                                    readonly
                                    value="{{! is_null($manutencaoCivilEletrica->data_hora_final_lem) ? $manutencaoCivilEletrica->data_hora_final_lem->format('H:i') : '    '}}"
                                />                                
                            </div>

                            <div class="form-inline wide">
                                <label>Início da Liberação LET:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    size="1"
                                    readonly
                                    value="{{! is_null($manutencaoCivilEletrica->data_hora_inicio_let) ? $manutencaoCivilEletrica->data_hora_inicio_let->format('H:i') : '    '}}"

                                />                                

                                <label>Término da Liberação:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    size="1"
                                    readonly
                                    value="{{! is_null($manutencaoCivilEletrica->data_hora_final_let) ? $manutencaoCivilEletrica->data_hora_final_let->format('H:i') : '    '}}"
                                />                                
                            </div>

                            <div class="form-inline">
                                <label>Início da Atividade:</label>
                                <input type="text"
                                    class="form-control form-control-plaintext"
                                    size="1"
                                    readonly
                                    value="{{! is_null($manutencaoCivilEletrica->data_hora_inicio_atividades) ? $manutencaoCivilEletrica->data_hora_inicio_atividades->format('H:i') : '    '}}"
                                />
                                
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
