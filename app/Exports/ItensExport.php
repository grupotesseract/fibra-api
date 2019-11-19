<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ItensExport implements FromQuery
{
    use Exportable;

    public function __construct(int $planta_id)
    {
        $this->planta_id = $planta_id;
    }    
    
    public function query()
    {
        return Item::query()->where('planta_id', $this->planta_id);
    }
}
