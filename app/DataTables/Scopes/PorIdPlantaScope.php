<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class PorIdPlantaScope implements DataTableScope
{
    private $plantaID;

    /**
     * @param $plantaID
     */
    public function __construct($plantaID)
    {
        $this->plantaID = $plantaID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $plantaID = $this->plantaID;

        return $query->whereHas('planta', function ($qRelacao) use ($plantaID) {
            $qRelacao->where('planta_id', $plantaID);
        });
    }
}
