<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

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
                $maxLinha = $event->getDelegate()->getHighestRow() + 2;

                //Ultima coluna ex: F
                $maxColuna = $event->getDelegate()->getHighestColumn();

                //Inserindo respiro
                $event->sheet->insertNewRowBefore(1, 2);

                //MERGE EM ALGUMAS CÉLULAS
                $event->sheet->mergeCells('A1:P1');
                $event->sheet->getCell('A1')->setValue($this->programacao->planta->nome.' - '.$this->programacao->data_inicio_prevista->format('m/Y'));
                $event->sheet->mergeCells('A2:A3');
                $event->sheet->getCell('A2')->setValue('Cód. Qrcode');
                $event->sheet->mergeCells('B2:B3');
                $event->sheet->getCell('B2')->setValue('Descrição');
                $event->sheet->mergeCells('C2:C3');
                $event->sheet->getCell('C2')->setValue('Circuito');
                $event->sheet->mergeCells('D2:I2');
                $event->sheet->getCell('D2')->setValue('Lâmpada');
                $event->sheet->mergeCells('J2:L2');
                $event->sheet->getCell('J2')->setValue('Quantidade Substituída');
                $event->sheet->mergeCells('M2:M3');
                $event->sheet->getCell('M2')->setValue('Data Manutenção');
                $event->sheet->mergeCells('N2:N3');
                $event->sheet->getCell('N2')->setValue('Horário Início');
                $event->sheet->mergeCells('O2:O3');
                $event->sheet->getCell('O2')->setValue('Horário Conclusão');
                $event->sheet->mergeCells('P2:P3');
                $event->sheet->getCell('P2')->setValue('Comentários');

                //settando height da linha 3 (cabeçalho)
                $event->sheet->getRowDimension('3')->setRowHeight(25);
                $event->sheet->getRowDimension('1')->setRowHeight(25);

                //FONTES
                $event->sheet->getStyle("A2:A$maxLinha")->getFont()
                    ->setSize(8);
                $event->sheet->getStyle("B2:B$maxLinha")->getFont()
                    ->setSize(10);
                $event->sheet->getStyle("C2:C$maxLinha")->getFont()
                    ->setSize(7);
                $event->sheet->getStyle("D2:I$maxLinha")->getFont()
                    ->setSize(8);
                $event->sheet->getStyle('J2')->getFont()
                    ->setSize(9);
                $event->sheet->getStyle('J3:L3')->getFont()
                    ->setSize(9);
                $event->sheet->getStyle("J4:L$maxLinha")->getFont()
                    ->setSize(10);
                $event->sheet->getStyle("M2:P$maxLinha")->getFont()
                    ->setSize(9);

                //ALINHAMENTOS
                $event->sheet->getStyle("A1:A$maxLinha")->getAlignment()
                    ->setHorizontal('center')->setVertical('center')->setWrapText(true);
                $event->sheet->getStyle("B2:B$maxLinha")->getAlignment()
                    ->setHorizontal('left')->setVertical('center')->setWrapText(true);
                $event->sheet->getStyle("C2:$maxColuna$maxLinha")->getAlignment()
                    ->setHorizontal('center')->setVertical('center')->setWrapText(true);

                //Aplicando borda no cabeçalho
                $event->sheet->getStyle("A1:$maxColuna$maxLinha")
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                $event->sheet->getStyle("J2:M$maxLinha")
                    ->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

                $event->sheet->getStyle("A1:$maxColuna".'2')
                    ->getFont()->setBold(true);

                //settando width das colunas A,B, C
                $event->sheet->getColumnDimension('A')->setWidth(5);
                $event->sheet->getColumnDimension('B')->setWidth(27);
                $event->sheet->getColumnDimension('C')->setWidth(7.29);
                $event->sheet->getColumnDimension('D')->setWidth(6);
                $event->sheet->getColumnDimension('E')->setWidth(6);
                $event->sheet->getColumnDimension('F')->setWidth(6);
                $event->sheet->getColumnDimension('G')->setWidth(6);
                $event->sheet->getColumnDimension('H')->setWidth(6);
                $event->sheet->getColumnDimension('I')->setWidth(6);
                $event->sheet->getColumnDimension('J')->setWidth(6);
                $event->sheet->getColumnDimension('K')->setWidth(6);
                $event->sheet->getColumnDimension('L')->setWidth(6);
                $event->sheet->getColumnDimension('M')->setWidth(9);
                $event->sheet->getColumnDimension('N')->setWidth(9);
                $event->sheet->getColumnDimension('O')->setWidth(9);
                $event->sheet->getColumnDimension('P')->setWidth(40);

                //incluindo filtro na range
                //$event->sheet->setAutoFilter("A2:$maxColuna$maxLinha");

                //CORES
                $event->sheet->getStyle('A1:P3')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FF9BC2E6');

                $event->sheet->getStyle("J4:J$maxLinha")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFFFFF00');

                for ($i = 4; $i <= $maxLinha; $i++) {
                    $valorCelula = $event->sheet->getCell("H$i")->getValue();
                    if (! is_null($valorCelula) && $valorCelula !== '') {
                        //pinta o BG da celula de amarelo
                        $event->sheet->getStyle("L$i")->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FFFFFF00');
                    } else {
                        $event->sheet->getStyle("L$i")->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FFA6A6A6');
                    }

                    $valorCelula = $event->sheet->getCell("I$i")->getValue();
                    if (! is_null($valorCelula) && $valorCelula !== '') {
                        //pinta o BG da celula de amarelo
                        $event->sheet->getStyle("K$i")->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FFFFFF00');
                    } else {
                        $event->sheet->getStyle("K$i")->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('FFA6A6A6');
                    }
                }
            },
        ];
    }
}
