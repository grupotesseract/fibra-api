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

                //Alterando alinhamento no cabeçalho
                $event->sheet->getStyle("A2:$maxColuna"."2")->getAlignment()
                    ->setVertical('center');

                //Alterando alinhamentos específicos
                $event->sheet->getStyle("A3:A$maxLinha")->getAlignment()
                    ->setVertical('center');

                $event->sheet->getStyle("B3:$maxColuna$maxLinha")->getAlignment()
                    ->setHorizontal('center')->setVertical('center');

                //Aplicando borda no cabeçalho
                $event->sheet->getStyle("A2:$maxColuna"."2")
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);

                $event->sheet->getStyle("A3:$maxColuna$maxLinha")
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                //incluindo filtro na range
                $event->sheet->setAutoFilter("A2:$maxColuna$maxLinha");
            },
        ];
    }
}
