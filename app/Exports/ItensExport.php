<?php

namespace App\Exports;

use App\Models\Item;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItensExport implements FromView
{

    public function __construct(int $planta_id, int $programacao_id)
    {
        $this->planta_id = $planta_id;
        $this->programacao_id = $programacao_id;
    }       
    

    public function view(): View
    {
        return view('itens.export', 
            [
                'itens' => Item::with(
                    [
                        'materiais' => function ($query) {
                            $query->whereHas(
                                'tipoMaterial', function ($query) {
                                    $query->where('tipo', 'Lâmpada');
                                }
                            );
                        },
                        'materiais.tipoMaterial', 
                        'materiais.reator',
                        'materiais.base',
                        'materiais.potencia',
                        'materiais.tensao',
                    ]
                )->where('planta_id', $this->planta_id)->get(),
                'programacao_id' => $this->programacao_id
            ]
        );


    }
}
