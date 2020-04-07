<?php

namespace App\Helpers;

/**
 * Classe para intermediar a comunicação com o PhpWord facilitando a construçao
 * das seções do relatorio diario de obra
 */
class RDOHelper extends PhpWordHelper
{

    /**
     * Retorna uma instancia de section do PhpWord já com as margens do documento.
     *
     * @return \PhpOffice\PhpWord\Element\Section
     */
    public static function addContainerSecoes($phpWord)
    {
        return $phpWord->addSection([
            'marginLeft' => 700,
            'marginRight' => 700,
            'marginTop' => 700,
            'marginBottom' => 700,
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
     * undocumented function
     *
     * @return void
     */
    public static function configuraEstilosTabelas($phpWord)
    {
        // Create a new table style
        $table_style = new \PhpOffice\PhpWord\Style\Table;
        $table_style->setBorderSize(1);
        $table_style->setUnit(\PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT);
        $table_style->setWidth(100 * 48);
        $table_style->setCellMarginLeft(80);

        $firstRowStyle = [
            'bgColor' => 'eeeeee',
            'alignment' => 'left',
        ];

        $phpWord->addTableStyle('TabelaEquipe', $table_style, $firstRowStyle);

    }


    /**
     * Cria o cabeçalho com o logo
     *
     * @return void
     */
    public function criarCabecalhoLogo($section)
    {
        // Create a new table style
        $table_style = new \PhpOffice\PhpWord\Style\Table;
        $table_style->setBorderColor('ffffff');
        $table_style->setBorderSize(1);
        $table_style->setUnit(\PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT);
        $table_style->setWidth(100 * 50);

        $table = $section->addTable($table_style);

        $table->addRow(200);
        $comprimentoCelula = 200;
        $cell = $table->addCell($comprimentoCelula);
        $cell->addImage(
            "http://res.cloudinary.com/api-fibra/image/upload/v1586216618/fibraheader_sbivuy.png",
            [
                'alignment'     => 'left',
                'width'         => 200,
                'wrappingStyle' => 'inline',
            ]
        );
        $section->addTextBreak(2);
    }

    /**
     * Cria a seção com retangulo azul e texto branco.
     *
     * @return void
     */
    public function criarSecaoRetanguloAzul($section, $texto='')
    {
        // Create a new table style
        $table_style = new \PhpOffice\PhpWord\Style\Table;
        $table_style->setBorderSize(1);
        $table_style->setUnit(\PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT);
        $table_style->setWidth(100 * 48);
        $table_style->setCellMargin(80);

        $table = $section->addTable($table_style);

        $table->addRow(80);

        $this->addPaddingTabela($table);

        $comprimentoCelula = 100*45;

        $cellStyle = [
            'bgColor' => '4f81bd',
            'alignment' => 'center',
            'valign' => 'center'
        ];

        $fontStyle = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'center',
            'color' => 'FFFFFF',
            'size' => 12
        ];

        $cell = $table->addCell($comprimentoCelula, $cellStyle);
        $cell->addText($texto, $fontStyle, ['alignment' => 'center']);

        $section->addTextBreak(1);
    }


    /**
     * Cria a secao com tabela listando a equipe do cliente
     *
     * @param \PhpOffice\PhpWord\Element\Section $section
     * @param mixed $arrEquipeCliente - Array com os nomes dos coloboradores
     */
    public function criarSecaoEquipeCliente($section, $arrEquipeCliente=[])
    {
        // Create a new table style
        $estiloTabela = $this->getEstiloTabelaPadrao();
        $comprimentoCelula=100*48;

        $table = $section->addTable($estiloTabela);

        $fontStylePrimeiraLinha = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'left',
            'color' => '000000',
            'size' => 11
        ];


        $table->addRow(40);
        $this->addPaddingTabela($table);

        //Estilo da celula do cabeçalho
        $cellStyle = [
            'bgColor' => 'eeeeee',
            'alignment' => 'left',
            'valign' => 'center'
        ];

        $cell = $table->addCell($comprimentoCelula, $cellStyle);
        $cell->addText('EQUIPE DE FISCALIZAÇÃO DO CLIENTE', $fontStylePrimeiraLinha, ['alignment' => 'left']);

        //Estilo da fonte das linhas da tabela
        $fontStyle = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => false,
            'align' => 'center',
            'color' => '000000',
            'size' => 11
        ];


        //incluindo uma ultima linha em branco na tabela
        array_push($arrEquipeCliente, ' ');

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrEquipeCliente as $nomePessoa) {
            $table->addRow(40);
            $this->addPaddingTabela($table);
            $cell = $table->addCell($comprimentoCelula);
            $cell->addText($nomePessoa, $fontStyle, ['alignment' => 'center']);
        }

        $section->addTextBreak(1);

    }


    /**
     * Cria a secao com tabela listando a equipe da fibra e seus horarios
     *
     * @param \PhpOffice\PhpWord\Element\Section $section
     * @param mixed $arrEquipeCliente - Array dos tecnicos e seus horarios.
     */
    public function criarSecaoEquipeFibra($section, $arrEquipeFibra=[])
    {
        if (empty($arrEquipeFibra)) {
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
        }

        $comprimentoCelula=100*48;

        $estiloTabela = $this->getEstiloTabelaPadrao();
        $table = $section->addTable($estiloTabela);

        $fontStylePrimeiraLinha = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'left',
            'color' => '000000',
            'size' => 11
        ];


        $table->addRow(40);
        $this->addPaddingTabela($table);

        //Estilo da celula do cabeçalho
        $cellStyle = [
            'bgColor' => 'eeeeee',
            'alignment' => 'left',
            'valign' => 'center'
        ];

        $cell = $table->addCell($comprimentoCelula, $cellStyle);
        $cell->addText('EQUIPE FIBRA ENGENHARIA', $fontStylePrimeiraLinha, ['alignment' => 'left']);


        //Estilo da fonte do segundo cabeçalho
        $estiloSegundoCabecalho = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'center',
            'color' => '000000',
            'size' => 11
        ];

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($comprimentoCelula*0.4);
        $cell->addText('COLABORADOR', $estiloSegundoCabecalho, ['alignment' => 'center']);

        $cell = $table->addCell($comprimentoCelula*0.15);
        $cell->addText('Entrada', $estiloSegundoCabecalho, ['alignment' => 'center']);

        $cell = $table->addCell($comprimentoCelula*0.15);
        $cell->addText('Saída', $estiloSegundoCabecalho, ['alignment' => 'center']);

        $cell = $table->addCell($comprimentoCelula*0.15);
        $cell->addText('Entrada', $estiloSegundoCabecalho, ['alignment' => 'center']);

        $cell = $table->addCell($comprimentoCelula*0.15);
        $cell->addText('Saída', $estiloSegundoCabecalho, ['alignment' => 'center']);

        //Estilo da fonte das linhas da tabela
        $estiloLinhaComum = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => false,
            'align' => 'center',
            'color' => '000000',
            'size' => 11
        ];

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrEquipeFibra as $key => $tecnicoHorarios) {

            $table->addRow(40);
            $this->addPaddingTabela($table);

            $cell = $table->addCell($comprimentoCelula*0.4);
            $cell->addText($arrEquipeFibra[$key]['nome'], $estiloLinhaComum, ['alignment' => 'center']);

            $cell = $table->addCell($comprimentoCelula*0.15);
            $cell->addText($arrEquipeFibra[$key]['entrada1'], $estiloLinhaComum, ['alignment' => 'center']);

            $cell = $table->addCell($comprimentoCelula*0.15);
            $cell->addText($arrEquipeFibra[$key]['saida1'], $estiloLinhaComum, ['alignment' => 'center']);

            $cell = $table->addCell($comprimentoCelula*0.15);
            $cell->addText($arrEquipeFibra[$key]['entrada2'], $estiloLinhaComum, ['alignment' => 'center']);

            $cell = $table->addCell($comprimentoCelula*0.15);
            $cell->addText($arrEquipeFibra[$key]['saida2'], $estiloLinhaComum, ['alignment' => 'center']);

        }

        $section->addTextBreak(1);
    }


    /**
     * Metodo para salvar o docx no arquivo relatorio.docx.
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     */
    public static function salvarDoc($phpWord, $pathArquivo='')
    {
        $pathStorage = 'RDO';
        $data = \Carbon\Carbon::now()->format('Y-m-d');
        $nomeArquivo = $data.'-RDO-'.time().'.docx';
        $path = \Storage::path("$pathStorage/$nomeArquivo");

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($path);
    }

    /**
     * Metodo para adicionar uma celula na tabela, sem bordas, para dar um padding
     *
     * @return void
     */
    public function addPaddingTabela($table)
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

        $table->addCell(100*2, $semBordas);

    }

    /**
     * Metodo para adicionar a secao Documentacoes Expedidas ao relatorio
     *
     * @param mixed $section
     * @param mixed $arrLinhasTexto - Array das linhas dessa seção
     */
    public function criarSecaoDocumentacoes($section, $arrLinhasTexto=[])
    {
        if (empty($arrLinhasTexto)) {
            $arrLinhasTexto = [
                "",
                "IT: ___________________________________.",
                "LEM/LET:_____________________________. ",
                "OS:__________________________________. ",
                "Início da Liberação LEM/LET: ____h____min, Término da Liberação: ____h____min.",
                "Início da Atividade: ____h____min.",
                "",
            ];
        }

        // Create a new table style
        $estiloTabela = $this->getEstiloTabelaPadrao();
        $comprimentoCelula=100*48;

        $table = $section->addTable($estiloTabela);

        $fontStylePrimeiraLinha = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'left',
            'color' => '000000',
            'size' => 11
        ];

        //Estilo da celula do cabeçalho
        $cellStyle = [
            'bgColor' => 'eeeeee',
            'alignment' => 'left',
            'valign' => 'center'
        ];

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($comprimentoCelula, $cellStyle);
        $cell->addText('DOCUMENTAÇÕES EXPEDIDAS NO DIA', $fontStylePrimeiraLinha, ['alignment' => 'left']);

        //Estilo da fonte das linhas da tabela
        $fontStyle = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'center',
            'color' => '000000',
            'size' => 11
        ];

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($comprimentoCelula);

        foreach($arrLinhasTexto as $linhaTexto) {
            $cell->addText($linhaTexto, $fontStyle, ['alignment' => 'left']);
        }

        $section->addTextBreak(1);

    }

    /**
     * Metodo para adicionar a secao Atividades Realizadas ao relatorio
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoAtividades($section, $arrAtividades=[])
    {
        if (empty($arrAtividades)) {
            $arrAtividades = [
                [
                    "atividade" => 'Atividade X',
                    "status" => 'Em Andamento',
                ],
                [
                    "atividade" => 'Atividade Y',
                    "status" => 'Concluída',
                ],
            ];
        }

        // Create a new table style
        $estiloTabela = $this->getEstiloTabelaPadrao();
        $comprimentoCelula=100*48;

        $table = $section->addTable($estiloTabela);

        $fontStylePrimeiraLinha = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'center',
            'color' => '000000',
            'size' => 11
        ];

        //Estilo da celula do cabeçalho
        $cellStyle = [
            'bgColor' => 'eeeeee',
            'alignment' => 'center',
            'valign' => 'center'
        ];

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($comprimentoCelula*0.75, $cellStyle);
        $cell->addText('Atividades Realizadas no dia', $fontStylePrimeiraLinha, ['alignment' => 'center']);

        $cell = $table->addCell($comprimentoCelula*0.25, $cellStyle);
        $cell->addText('Status (Em Andamento ou Concluída)', $fontStylePrimeiraLinha, ['alignment' => 'center']);

        //Estilo da fonte das linhas da tabela
        $estiloLinhaComum = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => false,
            'align' => 'left',
            'color' => '000000',
            'size' => 11
        ];

        $estiloLista = [
            'bold' => false,
            'listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED
        ];

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrAtividades as $key => $atividade) {

            $table->addRow(40);
            $this->addPaddingTabela($table);

            $cell = $table->addCell($comprimentoCelula*0.8);
            $cell->addListItem($arrAtividades[$key]['atividade'], 0, $estiloLinhaComum, $estiloLista, ['alignment' => 'left']);

            $cell = $table->addCell($comprimentoCelula*0.2);
            $cell->addText($arrAtividades[$key]['status'], $estiloLinhaComum, ['alignment' => 'center']);
        }

        $section->addTextBreak(1);

    }


    /**
     * Metodo para adicionar a secao Problemas encontrados ao relatorio
     *
     * @param mixed $section
     * @param mixed $arrAtividades
     */
    public function criarSecaoProblemas($section, $arrProblemas=[])
    {
        if (empty($arrProblemas)) {
            $arrProblemas = [
                'Problema 1',
                'Problema 2',
            ];
        }

        // Create a new table style
        $estiloTabela = $this->getEstiloTabelaPadrao();
        $comprimentoCelula=100*48;

        $table = $section->addTable($estiloTabela);

        $fontStylePrimeiraLinha = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'center',
            'color' => '000000',
            'size' => 11
        ];

        //Estilo da celula do cabeçalho
        $cellStyle = [
            'bgColor' => 'eeeeee',
            'alignment' => 'center',
            'valign' => 'center'
        ];

        $table->addRow(40);
        $this->addPaddingTabela($table);

        $cell = $table->addCell($comprimentoCelula, $cellStyle);
        $cell->addText('Problemas encontrados', $fontStylePrimeiraLinha, ['alignment' => 'center']);

        //Estilo da fonte das linhas da tabela
        $estiloLinhaComum = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => false,
            'align' => 'left',
            'color' => '000000',
            'size' => 11
        ];

        $estiloLista = [
            'bold' => false,
            'listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED
        ];

        //itera sob o array e imprime em linhas da tabela.
        foreach ($arrProblemas as $textoProblema) {

            $table->addRow(40);
            $this->addPaddingTabela($table);

            $cell = $table->addCell($comprimentoCelula);
            $cell->addListItem($textoProblema, 0, $estiloLinhaComum, $estiloLista, ['alignment' => 'left']);
        }

        $section->addTextBreak(1);

    }

    //criarSecaoInformacoesAdicionais
    //criarSecaoObservacoes
    //criarSecaoFotos
    //criarSecaoResponsaveis

    /**
     * Retorna o estilo da tabela padrão para ser utilizada na criação de uma nova tabela
     *
     * @return \PhpOffice\PhpWord\Style\Table;
     */
    public function getEstiloTabelaPadrao()
    {
        $table_style = new \PhpOffice\PhpWord\Style\Table;
        $table_style->setBorderSize(1);
        $table_style->setUnit(\PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT);
        $table_style->setWidth(100 * 48);
        $table_style->setCellMarginLeft(80);
        $table_style->setCellMarginTop(20);
        $table_style->setCellMarginBottom(20);

        return $table_style;
    }


}
