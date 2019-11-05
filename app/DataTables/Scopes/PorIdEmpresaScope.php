<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class PorIdEmpresaScope implements DataTableScope
{
    private $empresaID;

    /**
     * @param $empresaID
     */
    public function __construct($empresaID)
    {
        $this->empresaID = $empresaID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $empresaID = $this->empresaID;

        return $query->whereHas('empresa', function ($qRelacao) use ($empresaID) {
            $qRelacao->where('empresa_id', $empresaID);
        });
    }
}
