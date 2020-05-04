<?php

namespace App\Helpers;

/**
 * Classe para intermediar a comunicação com o PhpWord facilitando a construçao
 * das seções do Relatorio Diario de Obra (RDO).
 */
class RDOHelper extends PhpWordHelper
{
    public $medidaFullWidth = 4800;

    public $estiloTextoCabecalhoTabela = [
        'name' => 'Calibri',
        'allCaps' => true,
        'bold' => true,
        'align' => 'left',
        'color' => '000000',
        'size' => 11,
        'valign' => 'center',
    ];

    public $estiloCelulaCabecalhoTabela = [
        'bgColor' => 'eeeeee',
        'alignment' => 'left',
        'valign' => 'center',
        'cellMargin' => 30,
    ];

    public $estiloTextoTabela = [
        'name' => 'Calibri',
        'allCaps' => true,
        'bold' => false,
        'align' => 'left',
        'valign' => 'center',
        'color' => '000000',
        'size' => 11,
    ];

    public $estiloTextoAssinatura = [
        'name' => 'Calibri',
        'allCaps' => true,
        'bold' => false,
        'align' => 'center',
        'valign' => 'center',
        'color' => '000000',
        'size' => 11,
    ];

    public $estiloCelulaAssinatura = [
        'borderLeftSize' => 1,
        'borderRightSize' => 1,
        'borderTopSize' => 1,
        'borderBottomSize' => 1,
        'borderLeftColor' => 'ffffff',
        'borderRightColor' => 'ffffff',
        'borderTopColor' => '000000',
        'borderBottomColor' => 'ffffff',
        'valign' => 'center',
        'cellMargin' => 30,
    ];

    public $estiloLista = [
        'bold' => true,
        'listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED,
    ];

    /**
     * Retorna uma instancia de section do PhpWord já com as margens do documento.
     *
     * @return \PhpOffice\PhpWord\Element\Section
     */
    public static function addContainerSecoes($phpWord)
    {
        return $phpWord->addSection([
            'marginLeft' => 350,
            'marginRight' => 350,
            'marginTop' => 350,
            'marginBottom' => 350,
            'borderLeftSize' => 1,
            'borderRightSize' => 1,
            'borderTopSize' => 1,
            'borderBottomSize' => 1,
            'borderLeftColor' => '000000',
            'borderRightColor' => '000000',
            'borderTopColor' => '000000',
            'borderBottomColor' => '000000',
        ]);
    }

    /**
     * Cria o cabeçalho com o logo.
     *
     * @return void
     */
    public function criarCabecalhoLogo($section)
    {
        $table_style = $this->getEstiloTabelaPadrao();
        $table_style->setBorderColor('ffffff');

        $section->addTextBreak(1);

        $table = $section->addTable($table_style);
        $table->addRow(200);
        $this->addPaddingTabela($table);
        $cell = $table->addCell($this->medidaFullWidth);
        $cell->addImage(
            'http://res.cloudinary.com/api-fibra/image/upload/v1586216618/fibraheader_sbivuy.png',
            [
                'alignment'     => 'left',
                'width'         => 150,
                'wrappingStyle' => 'inline',
            ]
        );
        $section->addTextBreak(1);
    }

    /**
     * Cria a seção com retangulo azul e texto branco.
     *
     * @return void
     */
    public function criarSecaoRetanguloAzul($section, $texto = '')
    {
        $table_style = $this->getEstiloTabelaPadrao();
        $table_style->setCellMargin(50);

        $table = $section->addTable($table_style);

        $table->addRow(50);

        $this->addPaddingTabela($table, 2.7);

        $estiloCelulaRetangulo = [
            'bgColor' => '4f81bd',
            'alignment' => 'center',
            'valign' => 'center',
        ];

        $estiloTextoRetangulo = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'center',
            'valign' => 'center',
            'color' => 'FFFFFF',
            'size' => 11,
        ];

        $cell = $table->addCell($this->medidaFullWidth - 300, $estiloCelulaRetangulo);
        $cell->addText($texto, $estiloTextoRetangulo, ['alignment' => 'center']);

        $section->addTextBreak(1, ['size' => 2]);
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
        $section->addTextBreak(1, ['size' => 5]);

        $estiloTabela = $this->getEstiloTabelaPadrao();

        $table = $section->addTable($estiloTabela);

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($this->medidaFullWidth, $this->estiloCelulaCabecalhoTabela);
        $cell->addText('EQUIPE DE FISCALIZAÇÃO DO CLIENTE', $this->estiloTextoCabecalhoTabela, ['alignment' => 'left']);

        //incluindo uma ultima linha em branco na tabela
        array_push($arrEquipeCliente, ' ');

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrEquipeCliente as $nomePessoa) {
            $table->addRow(40);
            $this->addPaddingTabela($table);
            $cell = $table->addCell($this->medidaFullWidth);
            $cell->addText($nomePessoa, $this->estiloTextoTabela, ['alignment' => 'center']);
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
        if (! $manutencaoCivilEletrica) {
            $arrEquipeFibra = [
                [
                    'nome' => 'Tecnico 1',
                    'entrada1' => 'xxx',
                    'saida1' => 'xxx',
                    'entrada2' => 'yyy',
                    'saida2' => 'yyy',
                ],
                [
                    'nome' => 'Tecnico 2',
                    'entrada1' => 'xxx',
                    'saida1' => 'xxx',
                    'entrada2' => 'yyy',
                    'saida2' => 'yyy',
                ],
            ];
        } else {
            $equipeFibra = $manutencaoCivilEletrica->usuarios()->with('usuario')->get()->pluck('usuario.nome')->toArray();
            foreach ($equipeFibra as $equipe) {
                $arrEquipeFibra[] = [
                    'nome' => $equipe,
                    'entrada1' => $manutencaoCivilEletrica->data_hora_entrada ? $manutencaoCivilEletrica->data_hora_entrada->format('H:i') : '',
                    'saida1' => '12:00',
                    'entrada2' => '13:00',
                    'saida2' => $manutencaoCivilEletrica->data_hora_saida ? $manutencaoCivilEletrica->data_hora_saida->format('H:i') : '',
                ];
            }
        }

        $estiloTabela = $this->getEstiloTabelaPadrao();
        $table = $section->addTable($estiloTabela);

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($this->medidaFullWidth, $this->estiloCelulaCabecalhoTabela);
        $cell->addText('EQUIPE FIBRA ENGENHARIA', $this->estiloTextoCabecalhoTabela, ['alignment' => 'left']);

        //Estilo da fonte do segundo cabeçalho
        $estiloSegundoCabecalho = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'center',
            'color' => '000000',
            'size' => 11,
        ];

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($this->medidaFullWidth * 0.4);
        $cell->addText('COLABORADOR', $estiloSegundoCabecalho, ['alignment' => 'center']);

        $cell = $table->addCell($this->medidaFullWidth * 0.15);
        $cell->addText('Entrada', $estiloSegundoCabecalho, ['alignment' => 'center']);

        $cell = $table->addCell($this->medidaFullWidth * 0.15);
        $cell->addText('Saída', $estiloSegundoCabecalho, ['alignment' => 'center']);

        $cell = $table->addCell($this->medidaFullWidth * 0.15);
        $cell->addText('Entrada', $estiloSegundoCabecalho, ['alignment' => 'center']);

        $cell = $table->addCell($this->medidaFullWidth * 0.15);
        $cell->addText('Saída', $estiloSegundoCabecalho, ['alignment' => 'center']);

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrEquipeFibra as $key => $tecnicoHorarios) {
            $table->addRow(40);
            $this->addPaddingTabela($table);

            $cell = $table->addCell($this->medidaFullWidth * 0.4);
            $cell->addText($arrEquipeFibra[$key]['nome'], $this->estiloTextoTabela, ['alignment' => 'center']);

            $cell = $table->addCell($this->medidaFullWidth * 0.15);
            $cell->addText($arrEquipeFibra[$key]['entrada1'], $this->estiloTextoTabela, ['alignment' => 'center']);

            $cell = $table->addCell($this->medidaFullWidth * 0.15);
            $cell->addText($arrEquipeFibra[$key]['saida1'], $this->estiloTextoTabela, ['alignment' => 'center']);

            $cell = $table->addCell($this->medidaFullWidth * 0.15);
            $cell->addText($arrEquipeFibra[$key]['entrada2'], $this->estiloTextoTabela, ['alignment' => 'center']);

            $cell = $table->addCell($this->medidaFullWidth * 0.15);
            $cell->addText($arrEquipeFibra[$key]['saida2'], $this->estiloTextoTabela, ['alignment' => 'center']);
        }

        $section->addTextBreak(1);
    }

    /**
     * Metodo para salvar o docx no arquivo relatorio.docx.
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     *
     * @return void
     */
    public static function salvarDoc($phpWord, $pathArquivo = '')
    {
        $pathStorage = 'RDO';
        $data = \Carbon\Carbon::now()->format('Y-m-d');
        $nomeArquivo = $data.'-RDO-'.time().'.docx';
        $path = \Storage::path("$pathStorage/$nomeArquivo");

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($path);

        return $path;
    }

    /**
     * Metodo para adicionar a secao Documentacoes Expedidas ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrLinhasTexto - Array das linhas dessa seção
     *
     * @return void
     */
    public function criarSecaoDocumentacoes($section, $manutencaoCivilEletrica = null)
    {
        if (! $manutencaoCivilEletrica) {
            $arrLinhasTexto = [
                '',
                'IT: ___________________________________.',
                'LEM/LET:_____________________________. ',
                'OS:__________________________________. ',
                'Início da Liberação LEM/LET: ____h____min, Término da Liberação: ____h____min.',
                'Início da Atividade: ____h____min.',
                '',
            ];
        } else {
            $arrLinhasTexto = [
                '',
                "IT: $manutencaoCivilEletrica->it.",
                "LEM: $manutencaoCivilEletrica->lem.",
                "LET: $manutencaoCivilEletrica->let.",
                "OS: $manutencaoCivilEletrica->os.",
                'Início da Liberação LEM: '.$manutencaoCivilEletrica->data_hora_inicio_lem ? $manutencaoCivilEletrica->data_hora_inicio_lem->format('H:i') : ''.', Término da Liberação: '.$manutencaoCivilEletrica->data_hora_final_lem ? $manutencaoCivilEletrica->data_hora_final_lem->format('H:i') : ''.'.',
                'Início da Liberação LET: '.$manutencaoCivilEletrica->data_hora_inicio_let ? $manutencaoCivilEletrica->data_hora_inicio_let->format('H:i') : ''.', Término da Liberação: '.$manutencaoCivilEletrica->data_hora_final_let ? $manutencaoCivilEletrica->data_hora_final_let->format('H:i') : ''.'.',
                'Início da Atividade: '.$manutencaoCivilEletrica->data_hora_inicio_atividades ? $manutencaoCivilEletrica->data_hora_inicio_atividades->format('H:i') : '',
                '',
            ];
        }

        $estiloTabela = $this->getEstiloTabelaPadrao();
        $table = $section->addTable($estiloTabela);

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($this->medidaFullWidth, $this->estiloCelulaCabecalhoTabela);
        $cell->addText('DOCUMENTAÇÕES EXPEDIDAS NO DIA', $this->estiloTextoCabecalhoTabela, ['alignment' => 'left']);

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($this->medidaFullWidth);

        foreach ($arrLinhasTexto as $linhaTexto) {
            $cell->addText($linhaTexto, $this->estiloTextoTabela, ['alignment' => 'left']);
        }

        $section->addTextBreak(1);
    }

    /**
     * Metodo para adicionar a secao Atividades Realizadas ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoAtividades($section, $manutencaoCivilEletrica = null)
    {
        $arrAtividades = [];
        if (! $manutencaoCivilEletrica) {
            $arrAtividades = [
                [
                    'atividade' => 'Atividade X',
                    'status' => 'Em Andamento',
                ],
                [
                    'atividade' => 'Atividade Y',
                    'status' => 'Concluída',
                ],
            ];
        } else {
            $atividadesRealizadas = $manutencaoCivilEletrica->atividadesRealizadas;
            foreach ($atividadesRealizadas as $atividadeRealizada) {
                $arrAtividades[] = [
                    'atividade' => $atividadeRealizada->texto,
                    'status' => $atividadeRealizada->status ? 'CONCLUÍDA' : 'EM ANDAMENTO',
                ];
            }
        }

        $estiloTabela = $this->getEstiloTabelaPadrao();
        $table = $section->addTable($estiloTabela);

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($this->medidaFullWidth * 0.75, $this->estiloCelulaCabecalhoTabela);
        $cell->addText('Atividades Realizadas no dia', $this->estiloTextoCabecalhoTabela, ['alignment' => 'center']);

        $cell = $table->addCell($this->medidaFullWidth * 0.25, $this->estiloCelulaCabecalhoTabela);
        $cell->addText('Status (Em Andamento ou Concluída)', $this->estiloTextoCabecalhoTabela, ['alignment' => 'center']);

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrAtividades as $key => $atividade) {
            $table->addRow(40);
            $this->addPaddingTabela($table);

            $cell = $table->addCell($this->medidaFullWidth * 0.8);
            $cell->addListItem($arrAtividades[$key]['atividade'], 0, $this->estiloTextoTabela, $this->estiloLista, ['alignment' => 'left']);

            $cell = $table->addCell($this->medidaFullWidth * 0.2);
            $cell->addText($arrAtividades[$key]['status'], $this->estiloTextoTabela, ['alignment' => 'center']);
        }

        $section->addTextBreak(1);
    }

    /**
     * Metodo para adicionar a secao Problemas Encontrados ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoProblemas($section, $arrProblemas = [])
    {
        $this->createTabelaNumerada($section, 'Problemas Encontrados', $arrProblemas);
    }

    /**
     * Metodo para adicionar a secao Informações Adicionais ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoInformacoes($section, $arrInformacoes = [])
    {
        $this->createTabelaNumerada($section, 'Informações Adicionais', $arrInformacoes);
    }

    /**
     * Metodo para adicionar a secao Observações ao relatorio.
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoObservacoes($section, $arrObs = [])
    {
        $this->createTabelaNumerada($section, 'Observações', $arrObs);
    }

    /**
     * Metodo para incluir a secao Relatorio Fotografico ao relatorio.
     *
     * @return void
     */
    public function criarSecaoFotos($section, $arrFotos = [])
    {
        $section->addTextBreak(3);

        if (empty($arrFotos)) {
            $arrFotos = [
                'http://via.placeholder.com/150x150',
                'http://via.placeholder.com/150x150',
            ];
        }

        $estiloTabela = $this->getEstiloTabelaPadrao();
        $table = $section->addTable($estiloTabela);

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($this->medidaFullWidth, $this->estiloCelulaCabecalhoTabela);
        $cell->addText('RELATÓRIO FOTOGRÁFICO', $this->estiloTextoCabecalhoTabela, ['alignment' => 'left']);
        $section->addTextBreak(1);

        $estiloTabela->setBorderColor('ffffff');
        $table = $section->addTable($estiloTabela);

        foreach ($arrFotos as $urlFoto) {
            $table->addRow(250);
            $cell = $table->addCell($this->medidaFullWidth);
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
     * Metodo para incluir a secaos dos responsaveis no relatorio.
     *
     * @param mixed $section
     * @param mixed $arrResponsaveis
     *
     * @return void
     */
    public function criarSecaoResponsaveis($section, $manutencaoCivilEletrica = null)
    {
        if (! $manutencaoCivilEletrica) {
            $arrResponsaveis = [
                'fibra' => [
                    'nome' => 'Nome Responsavel Fibra',
                    'empresa' => 'FIBRA Serviços Especializados de Engenharia Ltda',
                ],
                'cliente' => [
                    'nome' => 'Nome Responsavel Cliente',
                    'empresa' => 'Empresa Cliente',
                ],
            ];
        } else {
            $arrResponsaveis = [
                'fibra' => [
                    'nome' => 'Thiago Pessutto Ruiz',
                    'empresa' => 'FIBRA Serviços Especializados de Engenharia Ltda',
                ],
                'cliente' => [
                    'nome' => $manutencaoCivilEletrica->equipe_cliente,
                    'empresa' => $manutencaoCivilEletrica->planta->empresa->nome,
                ],
            ];
        }

        $semBordas = [
            'borderLeftSize' => 1,
            'borderRightSize' => 1,
            'borderTopSize' => 1,
            'borderBottomSize' => 1,
            'borderLeftColor' => 'ffffff',
            'borderRightColor' => 'ffffff',
            'borderTopColor' => 'ffffff',
            'borderBottomColor' => 'ffffff',
        ];

        $estiloTabela = $this->getEstiloTabelaPadrao();

        $table = $section->addTable($estiloTabela);

        $table->addRow(40);
        $this->addPaddingTabela($table, 1.2);
        $cell = $table->addCell($this->medidaFullWidth * 0.1, $this->estiloCelulaAssinatura);
        $cell->addText($arrResponsaveis['fibra']['nome'], $this->estiloTextoAssinatura, ['alignment' => 'center']);

        $this->addPaddingTabela($table, 1.8);
        $cell = $table->addCell($this->medidaFullWidth * 0.1, $this->estiloCelulaAssinatura);
        $cell->addText($arrResponsaveis['cliente']['nome'], $this->estiloTextoAssinatura, ['alignment' => 'center']);

        $table->addRow(40);
        $this->addPaddingTabela($table, 1.2);
        $cell = $table->addCell($this->medidaFullWidth * 0.1, $semBordas);
        $cell->addText($arrResponsaveis['fibra']['empresa'], $this->estiloTextoAssinatura, ['alignment' => 'center']);

        $this->addPaddingTabela($table, 1.8);
        $cell = $table->addCell($this->medidaFullWidth * 0.1, $semBordas);
        $cell->addText($arrResponsaveis['cliente']['empresa'], $this->estiloTextoAssinatura, ['alignment' => 'center']);

        $table->addRow(40);
        $this->addPaddingTabela($table, 1.2);
        $cell = $table->addCell($this->medidaFullWidth * 0.1, $semBordas);
        $cell->addText('Responsável pela execução', $this->estiloTextoAssinatura, ['alignment' => 'center']);

        $this->addPaddingTabela($table, 1.8);
        $cell = $table->addCell($this->medidaFullWidth * 0.1, $semBordas);
        $cell->addText('Gestor do projeto', $this->estiloTextoAssinatura, ['alignment' => 'center']);
    }

    /**
     * Metodo para incluir o footer com o contador de paginas.
     *
     * @return void
     */
    public function criarFooter($section)
    {
        $footer = $section->addFooter();
        $footer->addPreserveText('Página {PAGE} de {NUMPAGES}.', null, ['alignment' => 'right']);
    }

    /**
     * Retorna o estilo da tabela padrão para ser utilizada na criação de uma nova tabela.
     *
     * @return \PhpOffice\PhpWord\Style\Table;
     */
    public function getEstiloTabelaPadrao()
    {
        $table_style = new \PhpOffice\PhpWord\Style\Table;
        $table_style->setBorderSize(1);
        $table_style->setUnit(\PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT);
        $table_style->setWidth($this->medidaFullWidth);
        $table_style->setCellMarginLeft(80);
        $table_style->setCellMarginTop(20);
        $table_style->setCellMarginBottom(20);

        return $table_style;
    }

    /**
     * Metodo para encapsular a criacao das tabelas utilizadas nas secões
     * 'Problemas Encontrados', 'Informações' e 'Observações'.
     *
     * @return void
     */
    public function createTabelaNumerada($section, $titulo, $itens)
    {
        if (empty($itens)) {
            $itens = [
                'N/A',
            ];
        }

        $estiloTabela = $this->getEstiloTabelaPadrao();
        $table = $section->addTable($estiloTabela);

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($this->medidaFullWidth, $this->estiloCelulaCabecalhoTabela);
        $cell->addText($titulo, $this->estiloTextoCabecalhoTabela, ['alignment' => 'center']);

        //itera sob o array e imprime em linhas da tabela.
        foreach ($itens as $item) {
            $table->addRow(40);
            $this->addPaddingTabela($table);

            $cell = $table->addCell($this->medidaFullWidth);
            $cell->addListItem($item, 0, $this->estiloTextoTabela, $this->estiloLista, ['alignment' => 'left']);
        }

        $section->addTextBreak(1);
    }

    /**
     * Metodo para adicionar uma celula na tabela, sem bordas, para dar um padding.
     *
     * @return void
     */
    public function addPaddingTabela($table, $tamanho = 3)
    {
        $semBordas = [
            'borderLeftSize' => 1,
            'borderRightSize' => 1,
            'borderTopSize' => 1,
            'borderBottomSize' => 1,
            'borderLeftColor' => 'ffffff',
            'borderRightColor' => 'ffffff',
            'borderTopColor' => 'ffffff',
            'borderBottomColor' => 'ffffff',
        ];

        $table->addCell(100 * $tamanho, $semBordas);
    }
}
