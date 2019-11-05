<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class PorIdLiberacaoDocumentoScope implements DataTableScope
{
    private $liberacaoDocumentoID;

    /**
     * @param $liberacaoDocumentoID
     */
    public function __construct($liberacaoDocumentoID)
    {
        $this->liberacaoDocumentoID = $liberacaoDocumentoID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $liberacaoDocumentoID = $this->liberacaoDocumentoID;

        return $query->whereHas('liberacoesDocumentos', function ($queryRel) use ($liberacaoDocumentoID) {
            $queryRel->where('liberacao_documento_id', $liberacaoDocumentoID);
        });
    }
}
