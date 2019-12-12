<?php

namespace App\Helpers;

/**
 * Classe para intermediar a comunicação com o PhpWord facilitando a construçao
 * das seções do documento word.
 */
class PhpWordHelper
{
    /**
     * Retorna uma instancia do PhpWord.
     *
     * @return \PhpOffice\PhpWord\PhpWord
     */
    public static function criarDoc()
    {
        return new \PhpOffice\PhpWord\PhpWord();
    }

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
        ]);
    }

    /**
     * Metodo para adicionar o bloco de titulo com numero e nome do item.
     *
     * @param \PhpOffice\PhpWord\Element\Section
     * @param string $numero
     * @param string $texto
     */
    public static function addSecaoTitulo($section, $numero, $texto)
    {
        $table = $section->addTable();
        $table->addRow();
        $cell = $table->addCell(1000);
        $cell->addText(' '.$numero, ['size' => 22]);
        $cell = $table->addCell(9700);
        $cell->addText($texto, ['size' => 22]);
    }

    /**
     * Metodo para adicionar a seção de fotos do item.
     *
     * Adicionando 3 fotos por linha.
     *
     * @param \PhpOffice\PhpWord\Element\Section
     * @param Illuminate\Database\Eloquent\Collection $fotos
     */
    public static function addSecaoFotos($section, $fotos)
    {
        $section->addTextBreak(1);

        foreach ($fotos->chunk(3) as $linhaFotos) {
            $table = $section->addTable();
            $table->addRow(2400);
            foreach ($linhaFotos as $foto) {
                $cell = $table->addCell(3566);
                $cell->addTextBreak(1);
                $cell->addImage(
                    $foto->urlParaRelatorio,
                    [
                        'height'        => 100,
                        'wrappingStyle' => 'inline',
                        'marginTop' => 100,
                    ]
                );
            }
            $section->addTextBreak(1);
        }

        $section->addTextBreak(4);
    }

    /**
     * Metodo para salvar o docx no arquivo relatorio.docx.
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     */
    public static function salvarDoc($phpWord)
    {
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('relatorio.docx');
    }
}
