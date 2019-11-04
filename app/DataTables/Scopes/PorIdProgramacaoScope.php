<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class PorIdProgramacaoScope implements DataTableScope
{
    private $programacaoID;

    /**
     * @param $programacaoID
     */
    public function __construct($programacaoID)
    {
        $this->programacaoID = $programacaoID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $programacaoID = $this->programacaoID;

        return $query->whereHas('programacao', function ($qProgramacao) use ($programacaoID) {
            $qProgramacao->where('programacao_id', $programacaoID);
        });
    }
}
