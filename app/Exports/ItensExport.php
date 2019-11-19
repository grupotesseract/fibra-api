<?php

namespace App\Exports;

use App\Models\Item;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItensExport implements FromView
{

    public function __construct(int $planta_id)
    {
        $this->planta_id = $planta_id;
    }       
    

    public function view(): View
    {
        return view('itens.export', 
            [
                'itens' => Item::with('materiais')->where('planta_id', $this->planta_id)->get()
            ]
        );


    }
}
