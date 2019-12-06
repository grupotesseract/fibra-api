<?php

namespace App\Helpers;

/**
 * Classe para intermediar a comunicação com o PhpWord facilitando a construçao
 * das seções do documento word
 */
class PhpWordHelper
{

    /**
     * Retorna uma intancia do PhpWord
     *
     * @return \PhpOffice\PhpWord\PhpWord
     */
    public static function criarDoc()
    {
        return new \PhpOffice\PhpWord\PhpWord();
    }

    /**
     * Metodo para adicioanar o bloco de titulo com o numero e nome do item
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
        $cell->addText(" ".$numero, ['size' => 22]);
        $cell = $table->addCell(8000);
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
        $section->addTextBreak(2);

        foreach ($fotos->chunk(3) as $linhaFotos) {
            $table = $section->addTable();
            $table->addRow(2400);
            foreach($linhaFotos as $foto) {
                $cell = $table->addCell(3000);
                $cell->addTextBreak(1);
                $cell->addImage(
                    $foto->urlParaRelatorio,
                    array(
                        'width'         => 140,
                        'height'        => 100,
                        'wrappingStyle' => 'inline',
                        'marginTop' => 100
                    )
                );
            }
            $section->addTextBreak(2);
        }
    }

    /**
     * Metodo para salvar o docx no arquivo relatorio.docx
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     */
    public static function salvarDoc($phpWord)
    {
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('relatorio.docx');
    }

}

