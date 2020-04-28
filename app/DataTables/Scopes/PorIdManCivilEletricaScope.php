<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class PorIdManCivilEletricaScope implements DataTableScope
{
    private $manCivilEletricaId;

    /**
     * @param $manCivilEletricaId
     */
    public function __construct($manCivilEletricaId)
    {
        $this->manCivilEletricaId = $manCivilEletricaId;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $manCivilEletricaId = $this->manCivilEletricaId;

        return $query->whereHas('manutencao', function ($qRelacao) use ($manCivilEletricaId) {
            $qRelacao->where('manutencao_id', $manCivilEletricaId);
        });
    }
}
