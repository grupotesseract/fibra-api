<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class QtdeResumidaMateriaisExport implements FromView, ShouldAutoSize
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
}
