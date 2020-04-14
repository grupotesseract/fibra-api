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
                $event->sheet->getRowDimension('1')->setRowHeight(35);

                //Alterando tamanho da fonte no cabeçalho
                $event->sheet->getStyle("A1")->getFont()
                    ->setSize(10);
                $event->sheet->getStyle("A2:A$maxLinha")->getFont()
                    ->setSize(9);
                $event->sheet->getStyle("B1:E$maxLinha")->getFont()
                    ->setSize(8);
                $event->sheet->getStyle("F1:L1")->getFont()
                    ->setSize(7);
                $event->sheet->getStyle("F2:L$maxLinha")->getFont()
                    ->setSize(10);

                //Alterando alinhamento no cabeçalho
                $event->sheet->getStyle("A1:$maxColuna".'2')->getAlignment()
                    ->setVertical('center')->setHorizontal('center')->setWrapText(true);

                //Alterando alinhamentos específicos                
                $event->sheet->getStyle("A2:$maxColuna$maxLinha")->getAlignment()
                    ->setHorizontal('center')->setVertical('center')->setWrapText(true);


                //Aplicando borda no conteúdo
                $event->sheet->getStyle("A1:$maxColuna$maxLinha")
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                //incluindo filtro na range
                //$event->sheet->setAutoFilter("A1:$maxColuna$maxLinha");

                $event->sheet->getColumnDimension('A')->setWidth(17);
                $event->sheet->getColumnDimension('B')->setWidth(6);
                $event->sheet->getColumnDimension('C')->setWidth(6);
                $event->sheet->getColumnDimension('D')->setWidth(6);
                $event->sheet->getColumnDimension('E')->setWidth(6);
                $event->sheet->getColumnDimension('F')->setWidth(8);
                $event->sheet->getColumnDimension('G')->setWidth(8);
                $event->sheet->getColumnDimension('H')->setWidth(8);
                $event->sheet->getColumnDimension('I')->setWidth(8);
                $event->sheet->getColumnDimension('J')->setWidth(8);
                $event->sheet->getColumnDimension('K')->setWidth(8);
                $event->sheet->getColumnDimension('L')->setWidth(8);


                $event->sheet->getStyle("A1:L1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FF9BC2E6');


                $event->sheet->getStyle("F2:F$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFCE4D6');

                $event->sheet->getStyle("G2:G$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFD9E1F2');

                $event->sheet->getStyle("H2:H$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFE2EFD9');

                $event->sheet->getStyle("I2:I$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFE2EFD9');

                $event->sheet->getStyle("J2:J$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFE2EFD9');

                $event->sheet->getStyle("K2:K$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFFF00');

                $event->sheet->getStyle("L2:L$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFCCCC');
            },
        ];
    }
}
