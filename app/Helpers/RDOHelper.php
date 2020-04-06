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

        $table->addRow(100);
        $comprimentoCelula = 100;
        $cell = $table->addCell($comprimentoCelula);
        $cell->addImage(
            "http://res.cloudinary.com/tesseract/image/upload/c_scale,h_36/v1568214892/fibra-api/logo_transparente.png",
            [
                'alignment'         => 'left',
                'width'         => 150,
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
     * @return void
     */
    public function criarSecaoEquipeCliente($section, $arrEquipeCliente=[])
    {
        // Create a new table style
        $table_style = new \PhpOffice\PhpWord\Style\Table;
        $table_style->setBorderSize(1);
        $table_style->setUnit(\PhpOffice\PhpWord\Style\Table::WIDTH_PERCENT);
        $table_style->setWidth(100 * 48);
        $table_style->setCellMarginLeft(80);
        $comprimentoCelula=100*48;

        $table = $section->addTable($table_style);

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

        $cellStyle = [
            'bgColor' => 'eeeeee',
            'alignment' => 'left',
            'valign' => 'center'
        ];

        $cell = $table->addCell($comprimentoCelula, $cellStyle);
        $cell->addText('EQUIPE DE FISCALIZAÇÃO DO CLIENTE', $fontStylePrimeiraLinha, ['alignment' => 'left']);

        $fontStyle = [
            'name' => 'Calibri',
            'allCaps' => true,
            'bold' => true,
            'align' => 'center',
            'color' => '000000',
            'size' => 11
        ];

        array_push($arrEquipeCliente, ' ');
        foreach ($arrEquipeCliente as $nomePessoa) {
            $table->addRow(40);
            $this->addPaddingTabela($table);
            $cell = $table->addCell($comprimentoCelula);
            $cell->addText($nomePessoa, $fontStyle, ['alignment' => 'center']);
        }

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

    //criarSecaoEquipeFibra
    //criarSecaoDocumentacoesExpedidas
    //criarSecaoAtividadesRealizadas
    //criarSecaoProblemasEncontrados
    //criarSecaoInformacoesAdicionais
    //criarSecaoObservacoes
    //criarSecaoFotos
    //criarSecaoResponsaveis

}
