<?php

namespace App\DataTables;

use App\Models\Material;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class MaterialDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'materiais.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Material $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Material $model)
    {
        return $model->newQuery();
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
            ->parameters(
                [
                    'dom'       => 'Bfrtip',
                    'stateSave' => true,
                    'order'     => [[0, 'desc']],
                    'buttons'   => [
                        ['extend' => 'create', 'text' => '<i class="fa fa-plus"></i> Adicionar', 'className' => 'btn btn-default btn-sm no-corner'],
                        ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> Exportar', 'className' => 'btn btn-default btn-sm no-corner'],
                        ['extend' => 'print', 'text' => '<i class="fa fa-print"></i> Imprimir', 'className' => 'btn btn-default btn-sm no-corner'],
                        ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i> Atualizar', 'className' => 'btn btn-default btn-sm no-corner'],
                    ],
                    'language' => [
                        'url' => url('//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json'),
                    ],
                ]
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'nome',
            'tipoMaterialNome' => ['data' => 'tipoMaterialNome', 'title' => 'Tipo de Material', 'searchable' => false],
            'potenciaValor' => ['data' => 'potenciaValor', 'title' => 'Potência', 'searchable' => false],
            'tensaoValor' => ['data' => 'tensaoValor', 'title' => 'Potência', 'searchable' => false],
            'reatorNome' => ['data' => 'reatorNome', 'title' => 'Reator', 'searchable' => false],
            'receptaculoNome' => ['data' => 'receptaculoNome', 'title' => 'Receptáculo', 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'materiaisdatatable_'.time();
    }
}