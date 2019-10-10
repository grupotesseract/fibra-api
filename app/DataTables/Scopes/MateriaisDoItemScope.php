<?php

namespace App\DataTables\Scopes;

use Yajra\DataTables\Contracts\DataTableScope;

class MateriaisDoItemScope implements DataTableScope
{
    private $itemID;

    /**
     * @param $itemID
     */
    public function __construct($itemID)
    {
        $this->itemID = $itemID;
    }

    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $itemID = $this->itemID;
        return $query->whereHas('items', function($qItem) use ($itemID) {
            $qItem->where('item_id', $itemID);
        });
    }
}
