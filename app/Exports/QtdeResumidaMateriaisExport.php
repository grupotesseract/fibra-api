<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class QtdeResumidaMateriaisExport implements FromView
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
