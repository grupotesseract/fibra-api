<?php

namespace App\Helpers;

class StylesHelper
{
    /**
     * Tamanho total da tela em Twip
     *
     * @var \PhpOffice\PhpWord\SimpleType\TblWidth
     */
    public $fullWidth = 5000;

    /**
     * Estilo referente ao logo da Fibra.
     *
     * @var \PhpOffice\PhpWord\Style\Image
     */
    public $logo = [
        'alignment'     => 'left',
        'wrappingStyle' => 'inline',
    ];

    // Blue Boxes
    // ================================================

    /**
     * Estilo dos retângulos azuis.
     *
     * @var \PhpOffice\PhpWord\Style\Cell
     */
    public $blueBox = [
        'bgColor'   => '#4f81bd',
        'alignment' => 'center',
        'valign'    => 'center',
    ];

    /**
     * Estilo dos retângulos azuis.
     *
     * @var \PhpOffice\PhpWord\Style\Paragraph
     */
    public $blueBoxParagraph = [
        'alignment'  => 'center',
        'spaceAfter' => 0,
    ];

    /**
     *
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $blueBoxFont = [
        'color'   => '#ffffff',
        'name'    => 'Calibri',
        'allCaps' => true,
        'bold'    => true,
        'size'    => 11,
    ];

    // Table Styles
    // ================================================

    /**
     * Estilo das tabelas.
     *
     * @var \PhpOffice\PhpWord\Style\Table
     */
    public $table = [
        'width'            => 5000,
        'unit'             => 'pct',
        'borderColor'      => '#AAAAAA',
        'borderSize'       => 1,
        'cellMarginTop'    => 0,
        'cellMarginLeft'   => 0,
        'cellMarginRight'  => 0,
        'cellMarginBottom' => 0,
    ];

    /**
     * Estilo das tabelas.
     *
     * @var \PhpOffice\PhpWord\Style\Cell
     */
    public $tableHeadCell = [
        'bgColor'    => '#c8ced3',
        'valign'     => 'center',
        'cellMargin' => 30,
    ];

    /**
     * Estilo do texto no thead.
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $tableHeadText = [
        'name'    => 'Calibri',
        'allCaps' => true,
        'bold'    => true,
        'color'   => '#444444',
        'size'    => 11,
    ];

    /**
     * Estilo do caption da tabela.
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $tableCaptionText = [
        'name'    => 'Calibri',
        'allCaps' => true,
        'bold'    => true,
        'align'   => 'center',
        'color'   => '444444',
        'size'    => 11,
    ];

    /**
     *
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $tableHeadTextSmall = [
        'name'    => 'Calibri',
        'allCaps' => true,
        'bold'    => true,
        'color'   => '#666666',
        'size'    => 8,
    ];

    /**
     * Estilo das tabelas.
     *
     * @var \PhpOffice\PhpWord\Style\Cell
     */
    public $tableHeadParagraph = [
        'spaceBefore' => 0,
        'spaceAfter' => 0,
        'spacing' => 0
    ];

    /**
     * Células das tabelas do PhpWord.
     *
     * @var array
     */
    public $tableCell = [
        'valign' => 'center',
    ];

    /**
     *
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $tableText = [
        'name'          => 'Calibri',
        'allCaps'       => false,
        'bold'          => false,
        'align'         => 'left',
        'textAlignment' => 'center',
        'color'         => '#444444',
        'size'          => 11,
    ];

    // Text related
    // ================================================

    /**
     * Quebra de linha padrão.
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $textBreak = [
        'size' => 11,
        'name' => 'Calibri',
    ];

    /**
     * Quebra de linha com tamanho de fonte reduzida.
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $textBreakSmall = [
        'size' => 1.5,
        'name' => 'Calibri',
    ];

    /**
     * Remove margens das quebras de linha.
     *
     * @var \PhpOffice\PhpWord\Style\Paragraph
     */
    public $textBreakParagraph = [
        'spaceBefore' => 0,
        'spaceAfter'  => 0,
        'spacing'     => 0,
    ];

    /**
     * Parágrafo do PhpWord centralizado.
     *
     * @var array \PhpOffice\PhpWord\Style\Paragraph
     */
    public $textCenter = [
        'alignment'   => 'center',
        'spaceBefore' => 0,
        'spaceAfter'  => 0,
        'spacing'     => 0,
    ];

    /**
     * Parágrafo do PhpWord alinhado à esquerda.
     *
     * @var array \PhpOffice\PhpWord\Style\Paragraph
     */
    public $textLeft = [
        'alignment'   => 'left',
        'spaceBefore' => 0,
        'spaceAfter'  => 0,
        'spacing'     => 0,
    ];

    /**
     * Estilo das listas
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $list = [
        'bold'     => true,
        'listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED,
    ];

    // Signature Section
    // ================================================

    /**
     * Assinatura no rodapé.
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $signatureText = [
        'name'    => 'Calibri',
        'allCaps' => false,
        'bold'    => false,
        'align'   => 'center',
        'valign'  => 'center',
        'color'   => '#444444',
        'size'    => 11,
    ];

    /**
     * Assinatura um pouco menor.
     *
     * @var \PhpOffice\PhpWord\Style\Font
     */
    public $signatureTextSmall = [
        'name'    => 'Calibri',
        'allCaps' => false,
        'bold'    => false,
        'align'   => 'center',
        'valign'  => 'center',
        'color'   => '#666666',
        'size'    => 10,
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    public $signatureCell = [
        'borderLeftSize'    => 1,
        'borderRightSize'   => 1,
        'borderTopSize'     => 1,
        'borderBottomSize'  => 1,
        'borderLeftColor'   => '#ffffff',
        'borderRightColor'  => '#ffffff',
        'borderTopColor'    => '#ffffff',
        'borderBottomColor' => '#ffffff',
        'valign'            => 'center',
        'cellMargin'        => 30,
    ];
}
