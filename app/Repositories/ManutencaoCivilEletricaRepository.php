<?php

namespace App\Repositories;

use App\Models\ManutencaoCivilEletrica;
use App\Repositories\BaseRepository;

/**
 * Class ManutencaoCivilEletricaRepository.
 * @version March 20, 2020, 2:54 pm -03
 */
class ManutencaoCivilEletricaRepository extends BaseRepository
{
    /**
     * @var array
     */
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
     **/
    public function model()
    {
        return ManutencaoCivilEletrica::class;
    }

    /**
     * Método para emissão do RDO
     *
     * @param ManutencaoCivilEletrica $manutencaoCivilEletrica
     * @return Object
     */
    public function relatorioRDO($manutencaoCivilEletrica) {
        //inicializando                                   
        $rdo = new \App\Helpers\RDOHelper();
        $doc = $rdo::criarDoc();           

        //pagina 1                         
        $section = $rdo::addContainerSecoes($doc); 
        $rdo->criarCabecalhoLogo($section);
        $rdo->criarSecaoRetanguloAzul($section, 'Local: '.$manutencaoCivilEletrica->planta->nome);
        $rdo->criarSecaoRetanguloAzul($section, 'Obra/Atividade: '.$manutencaoCivilEletrica->planta->nome);
        $rdo->criarSecaoRetanguloAzul($section, 'dd/mm/YYYY - DIA-DA-SEMANA'); 
        $rdo->criarSecaoEquipeCliente($section, ['Pessoa1', 'Pessoa2']);       
        $rdo->criarSecaoEquipeFibra($section);     
        $rdo->criarSecaoDocumentacoes($section);     
        $rdo->criarSecaoAtividades($section);      
        $rdo->criarSecaoProblemas($section);       
        $rdo->criarSecaoInformacoes($section);     
        $rdo->criarSecaoObservacoes($section);     
        $rdo->criarFooter($section);       

        //pagina 2                         
        $section = $rdo::addContainerSecoes($doc); 
        $rdo->criarCabecalhoLogo($section);
        $rdo->criarSecaoRetanguloAzul($section, 'Local: Xpto Xabaleu');
        $rdo->criarSecaoRetanguloAzul($section, 'Obra/Atividade: XXX LLL YYY');
        $rdo->criarSecaoRetanguloAzul($section, 'dd/mm/YYYY - DIA-DA-SEMANA'); 
        $rdo->criarSecaoFotos($section);   
        $rdo->criarSecaoResponsaveis($section);    
        $rdo->criarFooter($section);       

        return $rdo::salvarDoc($doc);        
    }
}
