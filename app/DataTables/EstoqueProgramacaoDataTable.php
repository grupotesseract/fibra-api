<?php

namespace App\DataTables;

use App\Models\Estoque;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class EstoqueProgramacaoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'estoque.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Estoque $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Estoque $model)
    {
        return $model->newQuery()->with('material');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false, 'title' => 'Ações'])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i> Atualizar', 'className' => 'btn btn-default btn-sm no-corner btnAtualizaDataTable'],
                    [ 'extend' => 'colvis', 'text'    => '<i class="fa fa-filter"></i> Filtrar Colunas', ]
                ],
                'language' => [
                    'url' => url('//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json'),
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'material' => [
                'data' => 'material.nomePotenciaTensao',
                'title' => 'Material',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
                'visible' => true,
            ],
            'material_id' => [
                'title' => 'ID Material',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
                'visible' => false,
            ],
            'programacao_id' => [
                'title' => 'ID Programação',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
                'visible' => false,
            ],
            'quantidade_inicial' => [
                'data' => 'quantidade_inicial',
                'title' => 'Qnt. Inicial',
                'searchable' => false,
                'orderable' => true,
                'filterable' => false,
                'visible' => true,
            ],
            'quantidade_final' => [
                'data' => 'quantidade_final',
                'title' => 'Qnt. Final',
                'searchable' => false,
                'orderable' => true,
                'filterable' => false,
                'visible' => true,
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'estoquedatatable_' . time();
    }
}
