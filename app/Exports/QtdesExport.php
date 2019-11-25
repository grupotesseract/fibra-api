<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class QtdesExport implements FromView
{

    public function __construct($programacao)
    {
        $this->programacao = $programacao;
    }       
    

    public function view(): View
    {
        return view('programacoes.relatorio.export', 
            [                
                'programacao' => $this->programacao
            ]
        );


    }
}
