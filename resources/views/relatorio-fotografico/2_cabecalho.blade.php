<section class="row">
    <div class="col-12">
        <div class="box">
            Local: {{ $manutencaoCivilEletrica->planta->nome }}
        </div>
    </div>

    <div class="col-12">
        <div class="box">
            Obra/Atividade: {{ $manutencaoCivilEletrica->obra_atividade }}
        </div>
    </div>

    <div class="col-12">
        <div class="box">
            {{ $manutencaoCivilEletrica->data_hora_entrada->format('d/m/Y').' - '.\App\Models\ManutencaoCivilEletrica::DIASSEMANA[$manutencaoCivilEletrica->data_hora_entrada->format('l')] }}
        </div>
    </div>
</section>
