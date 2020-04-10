<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class QtdesExport implements FromView, WithEvents
{
    public function __construct($programacao)
    {
        $this->programacao = $programacao;
    }

    public function view(): View
    {
        return view('programacoes.relatorio.relatorioSubstituicoes',
            [
                'programacao' => $this->programacao,
            ]
        );
    }

    /**
     * Metodo chamado para registrar os eventos no processo de montagem da planilha
     *
     * No AfterSheet é possivel aplicar regras de estilo após a view ter sido 'parseada'
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                //Ultima linha ex: 99
                $maxLinha = $event->getDelegate()->getHighestRow() + 1;

                //Ultima coluna ex: F
                $maxColuna = $event->getDelegate()->getHighestColumn();

                //Inserindo respiro
                $event->sheet->insertNewRowBefore(1, 1);

                //settando height da linha 1 (respiro)
                $event->sheet->getRowDimension('1')->setRowHeight(25);

                //settando height da linha 2 (cabeçalho)
                $event->sheet->getRowDimension('2')->setRowHeight(25);

                //Alterando tamanho da fonte no cabeçalho
                $event->sheet->getStyle("A2:$maxColuna$maxLinha")->getFont()
                    ->setSize(8);

                //Aplicando borda no cabeçalho
                $event->sheet->getStyle("A2:$maxColuna"."2")->getBorders()->getAllBorders()
                    ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

                //settando width das colunas A,B, C
                $event->sheet->getColumnDimension('A')->setWidth(15);
                $event->sheet->getColumnDimension('B')->setWidth(48);
                $event->sheet->getColumnDimension('C')->setWidth(6);
                $event->sheet->getColumnDimension($maxColuna)->setWidth(52);


                //incluindo filtro na range
                $event->sheet->setAutoFilter("A2:$maxColuna$maxLinha");

                //exemplo formatacao celula por celula de uma coluna
                for ($i = 3; $i < $maxLinha; $i++) {
                    $coluna = "J";

                    $valorCelula = $event->sheet->getCell("$coluna$i")->getValue();
                    //\Log::info("\n ## VALOR CELULA $coluna$i:" . $valorCelula);

                    //Se tiver valor na celula (string || numero>0)
                    if ($valorCelula >= 0) {

                        //pinta o BG da celula de amarelo
                        $event->sheet->getStyle("$coluna$i")->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FFFFFF00');
                    }
                }
            },
        ];
    }
}
