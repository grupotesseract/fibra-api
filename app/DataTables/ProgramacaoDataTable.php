<?php

namespace App\DataTables;

use App\Models\Programacao;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ProgramacaoDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'programacoes.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Programacao $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Programacao $model)
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
            ->addAction(['width' => '120px', 'printable' => false])
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
            'data_inicio_prevista',
            'data_fim_prevista',
            'data_inicio_real',
            'data_fim_real'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'programacoesdatatable_' . time();
    }
}
