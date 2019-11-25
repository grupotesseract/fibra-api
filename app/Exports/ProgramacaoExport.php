<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProgramacaoExport implements WithMultipleSheets
{
    use Exportable;
    
    protected $programacao;

    /**
     * COnstructor recebendo objeto de Programação
     *
     * @param Programacao $programacao Objeto de programação
     */
    public function __construct($programacao)
    {
        $this->programacao = $programacao;
    } 

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets[] = new QtdesExport($this->programacao);
        return $sheets;
    }
}
