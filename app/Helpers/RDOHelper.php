<?php

namespace App\Helpers;

use Carbon\Carbon;
use PhpOffice\PhpWord\Style\Table;
use Illuminate\Support\Facades\Storage;

/**
 * RDO Helper.
 *
 * Classe para intermediar a comunicação com o PhpWord
 * facilitando a construção das seções do Relatório Diário de Obra (RDO).
 *
 * @category Helpers
 */
class RDOHelper extends PhpWordHelper
{
    /**
     * Armazenará os estilos contidos no StylesHelper.
     *
     * @var \App\Helpers\StylesHelper
     */
    public $styles;

    /**
     * Cria uma instância do RDOHelper, que também inicializará
     * a instância do StylesHelper.
     */
    public function __construct()
    {
        $this->styles = new StylesHelper;
    }

    /**
     * Retorna uma instância de section do PhpWord já
     * com as margens do documento. As margens estão em Twip.
     *
     * @return \PhpOffice\PhpWord\Element\Section
     */
    public static function addContainerSecoes($phpWord)
    {
        return $phpWord->addSection([
            'marginLeft'   => 500,
            'marginRight'  => 500,
            'marginTop'    => 500,
            'marginBottom' => 500,
            'border'       => 0,
        ]);
    }

    /**
     * Cria o cabeçalho que será o container dos logos.
     *
     * @param \PhpOffice\PhpWord\Element\Section $section
     *
     * @return \PhpOffice\PhpWord\Element\Table
     */
    public function criarCabecalho($section)
    {
        $tableStyle = new Table($this->styles->table);
        $tableStyle->setBorderColor('#ffffff');
        $table = $section->addTable($tableStyle);
        $table->addRow(300);
        return $table;
    }

    public function criarHeader($section)
    {
        return $section->addHeader();
    }

    /**
     * Inclui o logo no cabeçalho.
     *
     * @param \PhpOffice\PhpWord\Element\Table $cabecalho
     * @param string $side  Define o lado que o logo será exibido no cabeçalho.
     *
     * @return void
     */
    public function criarCabecalhoLogo($cabecalho, $side = 'left', $img)
    {

        if (!$img) {
            $img = 'http://res.cloudinary.com/api-fibra/image/upload/v1586216618/fibraheader_sbivuy.png';
        } else {
            $this->styles->logo['width'] = 80;
        }

        $cell = $cabecalho->addCell($this->styles->fullWidth / 2, $this->styles->tableCell);
        $this->styles->logo['alignment'] = $side;
        $cell->addImage($img, $this->styles->logo);
        $this->styles->logo['width'] = 150;
    }

    /**
     * Cria a seção com retangulo azul e texto branco.
     *
     * @param \PhpOffice\PhpWord\Element\Section $section
     * @param string $texto
     *
     * @return void
     */
    public function criarSecaoRetanguloAzul($section, $texto = '')
    {
        $table = $section->addTable(new Table($this->styles->table));
        $table->addRow(500);
        $cell = $table->addCell($this->styles->fullWidth, $this->styles->blueBox);
        $cell->addText($texto, $this->styles->blueBoxFont, $this->styles->blueBoxParagraph);
        $section->addTextBreak(1, $this->styles->textBreakSmall, $this->styles->textBreakParagraph);
    }

    /**
     * Cria a secao com tabela listando a equipe do cliente.
     *
     * @param \PhpOffice\PhpWord\Element\Section $section
     * @param mixed $arrEquipeCliente - Array com os nomes dos coloboradores
     *
     * @return void
     */
    public function criarSecaoEquipeCliente($section, $arrEquipeCliente = [])
    {
        $section->addTextBreak(2, $this->styles->textBreakSmall, $this->styles->textBreakParagraph);
        $table = $section->addTable(new Table($this->styles->table));
        $table->addRow(350);
        $cell = $table->addCell($this->styles->fullWidth, $this->styles->tableHeadCell);
        $cell->addText('EQUIPE DE FISCALIZAÇÃO DO CLIENTE', $this->styles->tableHeadText, $this->styles->textLeft);

        // Incluindo uma ultima linha em branco na tabela
        array_push($arrEquipeCliente, ' ');

        // Percorre o array e imprime em linhas da tabela.
        foreach ($arrEquipeCliente as $nomePessoa) {
            $table->addRow(300);
            $cell = $table->addCell($this->styles->fullWidth, $this->styles->tableCell);
            $cell->addText($nomePessoa, $this->styles->tableText, $this->styles->textLeft);
        }

        $section->addTextBreak(1);
    }

    /**
     * Cria a secao com tabela listando a equipe da fibra e seus horarios.
     *
     * @param \PhpOffice\PhpWord\Element\Section $section
     * @param mixed $arrEquipeCliente - Array dos tecnicos e seus horarios.
     *
     * @return void
     */
    public function criarSecaoEquipeFibra($section, $manutencaoCivilEletrica = null)
    {
        $arrEquipeFibra = [];
        if (!$manutencaoCivilEletrica) {
            $arrEquipeFibra = [
                [
                    'nome'     => 'Tecnico 1',
                    'entrada1' => 'xxx',
                    'saida1'   => 'xxx',
                    'entrada2' => 'yyy',
                    'saida2'   => 'yyy',
                ],
                [
                    'nome'     => 'Tecnico 2',
                    'entrada1' => 'xxx',
                    'saida1'   => 'xxx',
                    'entrada2' => 'yyy',
                    'saida2'   => 'yyy',
                ],
            ];
        } else {
            $equipeFibra = $manutencaoCivilEletrica->usuarios()->with('usuario')->get()->pluck('usuario.nome')->toArray();
            foreach ($equipeFibra as $equipe) {
                $arrEquipeFibra[] = [
                    'nome'     => $equipe,
                    'entrada1' => $manutencaoCivilEletrica->data_hora_entrada ? $manutencaoCivilEletrica->data_hora_entrada->format('H:i') : '',
                    'saida1'   => '12:00',
                    'entrada2' => '13:00',
                    'saida2'   => $manutencaoCivilEletrica->data_hora_saida ? $manutencaoCivilEletrica->data_hora_saida->format('H:i') : '',
                ];
            }
        }

        $table = $section->addTable(new Table($this->styles->table));
        $table->addRow(350);

        $cell = $table->addCell($this->styles->fullWidth, $this->styles->tableHeadCell);
        $cell->addText('EQUIPE FIBRA ENGENHARIA', $this->styles->tableHeadText, $this->styles->textLeft);
        $cell->getStyle()->setGridSpan(5);

        $table->addRow(300);

        $cell = $table->addCell($this->styles->fullWidth * 0.4, $this->styles->tableCell);
        $cell->addText('COLABORADOR', $this->styles->tableCaptionText, $this->styles->textCenter);

        $cell = $table->addCell($this->styles->fullWidth * 0.15, $this->styles->tableCell);
        $cell->addText('Entrada', $this->styles->tableCaptionText, $this->styles->textCenter);

        $cell = $table->addCell($this->styles->fullWidth * 0.15, $this->styles->tableCell);
        $cell->addText('Saída', $this->styles->tableCaptionText, $this->styles->textCenter);

        $cell = $table->addCell($this->styles->fullWidth * 0.15, $this->styles->tableCell);
        $cell->addText('Entrada', $this->styles->tableCaptionText, $this->styles->textCenter);

        $cell = $table->addCell($this->styles->fullWidth * 0.15, $this->styles->tableCell);
        $cell->addText('Saída', $this->styles->tableCaptionText, $this->styles->textCenter);

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrEquipeFibra as $key => $tecnicoHorarios) {
            $table->addRow(300);

            $cell = $table->addCell($this->styles->fullWidth * 0.4, $this->styles->tableCell);
            $cell->addText($arrEquipeFibra[$key]['nome'], $this->styles->tableText, $this->styles->textLeft);

            $cell = $table->addCell($this->styles->fullWidth * 0.15, $this->styles->tableCell);
            $cell->addText($arrEquipeFibra[$key]['entrada1'], $this->styles->tableText, $this->styles->textCenter);

            $cell = $table->addCell($this->styles->fullWidth * 0.15, $this->styles->tableCell);
            $cell->addText($arrEquipeFibra[$key]['saida1'], $this->styles->tableText, $this->styles->textCenter);

            $cell = $table->addCell($this->styles->fullWidth * 0.15, $this->styles->tableCell);
            $cell->addText($arrEquipeFibra[$key]['entrada2'], $this->styles->tableText, $this->styles->textCenter);

            $cell = $table->addCell($this->styles->fullWidth * 0.15, $this->styles->tableCell);
            $cell->addText($arrEquipeFibra[$key]['saida2'], $this->styles->tableText, $this->styles->textCenter);
        }

        $section->addTextBreak(1);
    }

    /**
     * Método para salvar o docx no arquivo relatorio.docx.
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     *
     * @return void
     */
    public static function salvarDoc($phpWord, $pathArquivo = '')
    {
        $pathStorage = 'RDO';
        $data        = Carbon::now()->format('Y-m-d');
        $nomeArquivo = $data . '-RDO-' . time() . '.docx';
        $path        = Storage::path("$pathStorage/$nomeArquivo");

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($path);

        return $path;
    }

    /**
     * Metódo para adicionar a seção Documentações Expedidas ao relatório.
     *
     * @param mixed $section
     * @param mixed $manutencaoCivilEletrica - Array das linhas dessa seção
     *
     * @return void
     */
    public function criarSecaoDocumentacoes($section, $manutencaoCivilEletrica = null)
    {
        if (!$manutencaoCivilEletrica) {
            $arrLinhasTexto = [
                'IT: ___________________________________.',
                'LEM/LET: _____________________________. ',
                'OS: __________________________________. ',
                'Início da Liberação LEM/LET: ____h____min, Término da Liberação: ____h____min.',
                'Início da Atividade: ____h____min.',
            ];
        } else {
            $inicioLiberacaoLEM = $manutencaoCivilEletrica->data_hora_inicio_lem ? 'Início da Liberação LEM: '.$manutencaoCivilEletrica->data_hora_inicio_lem->format('H:i') : '    ';
            $finalLiberacaoLEM  = $manutencaoCivilEletrica->data_hora_final_lem ? ', Término da Liberação: '.$manutencaoCivilEletrica->data_hora_final_lem->format('H:i'). '.' : '    ';
            $inicioLiberacaoLET = $manutencaoCivilEletrica->data_hora_inicio_let ? 'Início da Liberação LET: ' . $manutencaoCivilEletrica->data_hora_inicio_let->format('H:i') : '    ';
            $finalLiberacaoLET  = $manutencaoCivilEletrica->data_hora_final_let ? ', Término da Liberação: ' . $manutencaoCivilEletrica->data_hora_final_let->format('H:i'). '.' : '    ';
            $inicioAtividade    = $manutencaoCivilEletrica->data_hora_inicio_atividades ? 'Início da Atividade: ' . $manutencaoCivilEletrica->data_hora_inicio_atividades->format('H:i') : '    ';
            $arrLinhasTexto     = [
                $manutencaoCivilEletrica->it && $manutencaoCivilEletrica->it !== '' ? "IT: $manutencaoCivilEletrica->it." : '',
                $manutencaoCivilEletrica->lem && $manutencaoCivilEletrica->lem !== '' ? "LEM: $manutencaoCivilEletrica->lem." : '',
                $manutencaoCivilEletrica->let && $manutencaoCivilEletrica->let !== '' ? "LET: $manutencaoCivilEletrica->let." : '',
                $manutencaoCivilEletrica->os && $manutencaoCivilEletrica->os !== '' ? "OS: $manutencaoCivilEletrica->os." : '',
                $inicioLiberacaoLEM . $finalLiberacaoLEM,
                $inicioLiberacaoLET . $finalLiberacaoLET,
                $inicioAtividade,
            ];
        }

        $table = $section->addTable(new Table($this->styles->table));
        $table->addRow(300);

        $cell = $table->addCell($this->styles->fullWidth, $this->styles->tableHeadCell);
        $cell->addText('DOCUMENTAÇÕES EXPEDIDAS NO DIA', $this->styles->tableHeadText, $this->styles->textLeft);

        $table->addRow(300);
        $cell = $table->addCell($this->styles->fullWidth);

        foreach ($arrLinhasTexto as $linhaTexto) {
            if ($linhaTexto && $linhaTexto !== '') {
                $cell->addText($linhaTexto, $this->styles->tableText, $this->styles->textLeft);
            }
        }

        $section->addTextBreak(1);
    }

    /**
     * Método para adicionar a secao Atividades Realizadas ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoAtividades($section, $manutencaoCivilEletrica = null)
    {
        $arrAtividades = [];
        if (!$manutencaoCivilEletrica) {
            $arrAtividades = [
                [
                    'atividade' => 'Atividade X',
                    'status'    => 'Em Andamento',
                ],
                [
                    'atividade' => 'Atividade Y',
                    'status'    => 'Concluída',
                ],
            ];
        } else {
            $atividadesRealizadas = $manutencaoCivilEletrica->atividadesRealizadas;
            foreach ($atividadesRealizadas as $atividadeRealizada) {
                $arrAtividades[] = [
                    'atividade' => $atividadeRealizada->texto,
                    'status'    => $atividadeRealizada->status ? 'CONCLUÍDA' : 'EM ANDAMENTO',
                ];
            }
        }

        $table = $section->addTable(new Table($this->styles->table));
        $table->addRow(300);

        $cell = $table->addCell($this->styles->fullWidth * 0.7, $this->styles->tableHeadCell);
        $cell->addText('Atividades Realizadas no dia', $this->styles->tableHeadText, $this->styles->textCenter);

        $cell = $table->addCell($this->styles->fullWidth * 0.3, $this->styles->tableHeadCell);
        $cell->addText('Status', $this->styles->tableHeadText, $this->styles->textCenter);
        $cell->addText('(Em Andamento ou Concluída)', $this->styles->tableHeadTextSmall, $this->styles->textCenter);

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrAtividades as $key => $atividade) {
            $table->addRow(300);

            $cell = $table->addCell($this->styles->fullWidth * 0.8, $this->styles->tableCell);
            $cell->addListItem($arrAtividades[$key]['atividade'], 0, $this->styles->tableText, $this->styles->list, $this->styles->textLeft);

            $cell = $table->addCell($this->styles->fullWidth * 0.2, $this->styles->tableCell);
            $cell->addText($arrAtividades[$key]['status'], $this->styles->tableText, $this->styles->textCenter);
        }

        $section->addTextBreak(1);
    }

    /**
     * Método para adicionar a secao Problemas Encontrados ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoProblemas($section, $arrProblemas = [])
    {
        $this->createTabelaNumerada($section, 'Problemas Encontrados', $arrProblemas);
    }

    /**
     * Método para adicionar a secao Informações Adicionais ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoInformacoes($section, $arrInformacoes = [])
    {
        $this->createTabelaNumerada($section, 'Informações Adicionais', $arrInformacoes);
    }

    /**
     * Método para adicionar a secao Observações ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoObservacoes($section, $arrObs = [])
    {
        $this->createTabelaNumerada($section, 'Observações', $arrObs);
    }

    /**
     * Método para incluir a secao Relatorio Fotografico ao relatorio.
     *
     * @return void
     */
    public function criarSecaoFotos($section, $arrFotos = [])
    {
        $section->addTextBreak(1);

        if (empty($arrFotos)) {
            $arrFotos = [
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
            ];
        }

        $table = $section->addTable(new Table($this->styles->table));
        $table->addRow(300);

        $cell = $table->addCell($this->styles->fullWidth, $this->styles->tableHeadCell);
        $cell->addText('RELATÓRIO FOTOGRÁFICO', $this->styles->tableHeadText, $this->styles->textCenter);
        $section->addTextBreak(1);

        $tableStyle = new Table($this->styles->table);
        $tableStyle->setBorderColor('#ffffff');
        $table = $section->addTable($tableStyle);

        foreach ($arrFotos as $urlFoto) {
            $table->addRow(250);
            $cell = $table->addCell($this->styles->fullWidth);
            $cell->addImage(
                $urlFoto,
                [
                    'alignment'     => 'center',
                    'width'         => 150,
                    'wrappingStyle' => 'inline',
                ]
            );
            $cell->addTextBreak(1);
        }

        $section->addTextBreak(3);
    }

    /**
     * Método para incluir a secaos dos responsaveis no relatorio.
     *
     * @param mixed $section
     * @param mixed $arrResponsaveis
     *
     * @return void
     */
    public function criarSecaoResponsaveis($section, $manutencaoCivilEletrica = null)
    {
        if (!$manutencaoCivilEletrica) {
            $arrResponsaveis = [
                'fibra'   => [
                    'nome'    => 'Nome Responsavel Fibra',
                    'empresa' => 'FIBRA Serviços Especializados de Engenharia Ltda',
                ],
                'cliente' => [
                    'nome'    => 'Nome Responsavel Cliente',
                    'empresa' => 'Empresa Cliente',
                ],
            ];
        } else {
            $arrResponsaveis = [
                'fibra'   => [
                    'nome'    => 'Thiago Pessutto Ruiz',
                    'empresa' => 'FIBRA Serviços Especializados de Engenharia Ltda',
                ],
                'cliente' => [
                    'nome'    => $manutencaoCivilEletrica->equipe_cliente,
                    'empresa' => $manutencaoCivilEletrica->planta->empresa->nome,
                ],
            ];
        }

        $semBordas = [
            'borderLeftSize'    => 1,
            'borderRightSize'   => 1,
            'borderTopSize'     => 1,
            'borderBottomSize'  => 1,
            'borderLeftColor'   => 'ffffff',
            'borderRightColor'  => 'ffffff',
            'borderTopColor'    => 'ffffff',
            'borderBottomColor' => 'ffffff',
        ];

        $table = $section->addTable(new Table($this->styles->table));

        $table->addRow(300);
        $cell = $table->addCell($this->styles->fullWidth * 0.5, $this->styles->signatureCell);
        $cell->addText('____________________________________', $this->styles->signatureText, $this->styles->textCenter);
        $cell->addText('', $this->styles->signatureText, $this->styles->textCenter);
        $cell->addText($arrResponsaveis['fibra']['nome'], $this->styles->signatureText, $this->styles->textCenter);
        $cell = $table->addCell($this->styles->fullWidth * 0.5, $this->styles->signatureCell);
        $cell->addText('____________________________________', $this->styles->signatureText, $this->styles->textCenter);
        $cell->addText('', $this->styles->signatureText, $this->styles->textCenter);
        $cell->addText($arrResponsaveis['cliente']['nome'], $this->styles->signatureText, $this->styles->textCenter);

        $table->addRow(300);
        $cell = $table->addCell($this->styles->fullWidth * 0.5, $semBordas);
        $cell->addText($arrResponsaveis['fibra']['empresa'], $this->styles->signatureTextSmall, $this->styles->textCenter);
        $cell = $table->addCell($this->styles->fullWidth * 0.5, $semBordas);
        $cell->addText($arrResponsaveis['cliente']['empresa'], $this->styles->signatureTextSmall, $this->styles->textCenter);

        $table->addRow(300);
        $cell = $table->addCell($this->styles->fullWidth * 0.5, $semBordas);
        $cell->addText('Responsável pela execução', $this->styles->signatureTextSmall, $this->styles->textCenter);
        $cell = $table->addCell($this->styles->fullWidth * 0.1, $semBordas);
        $cell->addText('Gestor do projeto', $this->styles->signatureTextSmall, $this->styles->textCenter);
    }

    /**
     * Método para incluir o footer com o contador de paginas.
     *
     * @return void
     */
    public function criarFooter($section)
    {
        $footer = $section->addFooter();
        $footer->addPreserveText('Página {PAGE} de {NUMPAGES}.', null, ['alignment' => 'right']);
    }

    /**
     * Método para encapsular a criacao das tabelas utilizadas nas secões
     * 'Problemas Encontrados', 'Informações' e 'Observações'.
     *
     * @return void
     */
    public function createTabelaNumerada($section, $titulo, $itens)
    {
        if (empty($itens)) {
            $itens = ['N/A'];
        }

        $table = $section->addTable(new Table($this->styles->table));
        $table->addRow(300);

        $cell = $table->addCell($this->styles->fullWidth, $this->styles->tableHeadCell);
        $cell->addText($titulo, $this->styles->tableHeadText, $this->styles->textCenter);

        //itera sob o array e imprime em linhas da tabela.
        foreach ($itens as $item) {
            $table->addRow(300);

            $cell = $table->addCell($this->styles->fullWidth, $this->styles->tableCell);
            $cell->addText($item, $this->styles->tableText, $this->styles->textLeft);
        }

        $section->addTextBreak(1);
    }
}
