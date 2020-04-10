<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class QtdeResumidaMateriaisExport implements FromView, WithEvents
{
    public function __construct($programacao)
    {
        $this->programacao = $programacao;
    }

    public function view(): View
    {
        return view('programacoes.relatorio.relatorioQtdeResumidaMateriais',
            [
                'programacao' => $this->programacao,
            ]
        );
    }

    /**
     * Metodo chamado para registrar os eventos no processo de montagem da planilha.
     *
     * No AfterSheet é possivel aplicar regras de estilo após a view ter sido 'parseada'
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {

                //Ultima linha ex: 99
                $maxLinha = $event->getDelegate()->getHighestRow();

                //Ultima coluna ex: F
                $maxColuna = $event->getDelegate()->getHighestColumn();

                //settando height da linha 1 (cabeçalho)
                $event->sheet->getRowDimension('1')->setRowHeight(30);

                //Alterando tamanho da fonte no cabeçalho
                $event->sheet->getStyle("A1:$maxColuna$maxLinha")->getFont()
                    ->setSize(8);

                //Alterando alinhamento no cabeçalho
                $event->sheet->getStyle("A1:$maxColuna".'2')->getAlignment()
                    ->setVertical('center')->setHorizontal('center')->setWrapText(true);

                //Alterando alinhamentos específicos
                $event->sheet->getStyle("A2:A$maxLinha")->getAlignment()
                    ->setVertical('center')->setHorizontal('left');

                $event->sheet->getStyle("B2:$maxColuna$maxLinha")->getAlignment()
                    ->setHorizontal('center')->setVertical('center');

                //Aplicando borda no cabeçalho
                $event->sheet->getStyle("A1:$maxColuna".'2')
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

                //Aplicando borda no conteúdo
                $event->sheet->getStyle("A2:$maxColuna$maxLinha")
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                //incluindo filtro na range
                $event->sheet->setAutoFilter("A1:$maxColuna$maxLinha");

                $event->sheet->getColumnDimension('A')->setWidth(15);

                $event->sheet->getColumnDimension('F')->setWidth(15);
                $event->sheet->getStyle("F1:F$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFCF78D');

                $event->sheet->getColumnDimension('G')->setWidth(15);
                $event->sheet->getStyle("G1:G$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFE6FF');

                $event->sheet->getColumnDimension('H')->setWidth(15);
                $event->sheet->getStyle("H1:H$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFEBEBE0');

                $event->sheet->getColumnDimension('I')->setWidth(15);
                $event->sheet->getStyle("I1:I$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFEBEBE0');

                $event->sheet->getColumnDimension('J')->setWidth(15);
                $event->sheet->getStyle("J1:J$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFEBEBE0');

                $event->sheet->getColumnDimension('K')->setWidth(15);
                $event->sheet->getStyle("K1:K$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFE6F2FF');

                $event->sheet->getColumnDimension('L')->setWidth(20);
                $event->sheet->getStyle("L1:L$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFE6E6');
            },
        ];
    }
}
