<?php

namespace App\Repositories;

use App\Helpers\RDOHelper;
use App\Repositories\BaseRepository;
use App\Models\ManutencaoCivilEletrica;

/**
 * Class ManutencaoCivilEletricaRepository.
 *
 * @version March 20, 2020, 2:54 pm -03
 */
class ManutencaoCivilEletricaRepository extends BaseRepository
{
    const DIASSEMANA = [
        'Sunday'    => 'DOMINGO',
        'Monday'    => 'SEGUNDA-FEIRA',
        'Tuesday'   => 'TERÇA-FEIRA',
        'Wednesday' => 'QUARTA-FEIRA',
        'Thursday'  => 'QUINTA-FEIRA',
        'Friday'    => 'SEXTA-FEIRA',
        'Saturday'  => 'SÁBADO',
    ];

    protected $fieldSearchable = [
        'data_hora_entrada',
        'data_hora_saida',
        'data_hora_inicio_lem',
        'data_hora_final_lem',
        'data_hora_inicio_let',
        'data_hora_final_let',
        'data_hora_inicio_atividades',
        'planta_id',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     */
    public function model()
    {
        return ManutencaoCivilEletrica::class;
    }

    /**
     * Método para emissão do RDO.
     *
     * @param ManutencaoCivilEletrica $manutencaoCivilEletrica
     *
     * @return object
     */
    public function relatorioRDO($manutencaoCivilEletrica)
    {
        $rdo = new RDOHelper;
        $doc = $rdo::criarDoc();
        $arrURLFotos = $manutencaoCivilEletrica->fotos->pluck('URLParaRelatorio')->all();

        // Página 1
        $section = $rdo::addContainerSecoes($doc);
        $cabecalho = $rdo->criarCabecalho($section);
        $rdo->criarCabecalhoLogo($cabecalho, 'left');
        $rdo->criarCabecalhoLogo($cabecalho, 'right', $manutencaoCivilEletrica->planta->empresa->path_imagem);
        $rdo->criarSecaoRetanguloAzul($section, 'Local: ' . $manutencaoCivilEletrica->planta->nome);
        $rdo->criarSecaoRetanguloAzul($section, 'Obra/Atividade: ' . $manutencaoCivilEletrica->obra_atividade);
        $rdo->criarSecaoRetanguloAzul($section, $manutencaoCivilEletrica->data_hora_entrada->format('d/m/Y') . ' - ' . self::DIASSEMANA[$manutencaoCivilEletrica->data_hora_entrada->format('l')]);
        $rdo->criarSecaoEquipeCliente($section, [$manutencaoCivilEletrica->equipe_cliente]);
        $rdo->criarSecaoEquipeFibra($section, $manutencaoCivilEletrica);
        $rdo->criarSecaoDocumentacoes($section, $manutencaoCivilEletrica);
        $rdo->criarSecaoAtividades($section, $manutencaoCivilEletrica);
        $rdo->criarSecaoProblemas($section, [$manutencaoCivilEletrica->problemas_encontrados]);
        $rdo->criarSecaoInformacoes($section, [$manutencaoCivilEletrica->informacoes_adicionais]);
        $rdo->criarSecaoObservacoes($section, [$manutencaoCivilEletrica->observacoes]);
        $rdo->criarFooter($section);

        // Página 2
        $section = $rdo::addContainerSecoes($doc);
        $cabecalho = $rdo->criarCabecalho($section);
        $rdo->criarCabecalhoLogo($cabecalho, 'left');
        $rdo->criarCabecalhoLogo($cabecalho, 'right', $manutencaoCivilEletrica->planta->empresa->path_imagem);

        $rdo->criarSecaoRetanguloAzul($section, 'Local: '.$manutencaoCivilEletrica->planta->nome);
        $rdo->criarSecaoRetanguloAzul($section, 'Obra/Atividade: '.$manutencaoCivilEletrica->obra_atividade);
        $rdo->criarSecaoRetanguloAzul($section, $manutencaoCivilEletrica->data_hora_entrada->format('d/m/Y').' - '.self::DIASSEMANA[$manutencaoCivilEletrica->data_hora_entrada->format('l')]);
        $rdo->criarSecaoFotos($section, $arrURLFotos);
        $rdo->criarSecaoResponsaveis($section, $manutencaoCivilEletrica);
        $rdo->criarFooter($section);

        return $rdo::salvarDoc($doc);
    }
}
