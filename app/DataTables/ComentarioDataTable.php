<?php

namespace App\DataTables;

use App\Models\Comentario;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ComentarioDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'comentarios.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Comentario $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Comentario $model)
    {
        return $model->with('item');
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
                    ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> Exportar', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i> Atualizar', 'className' => 'btn btn-default btn-sm no-corner btnAtualizaDataTable'],
                    ['extend' => 'colvis', 'text'    => '<i class="fa fa-filter"></i> Filtrar Colunas'],
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
            'qrcode' => [
                'data' => 'item.qrcode',
                'title' => 'QRCode',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
            ],
            'nome' => [
                'data' => 'item.nome',
                'title' => 'Nome do Item',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
            ],
            'comentario',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'comentariosdatatable_'.time();
    }
}
