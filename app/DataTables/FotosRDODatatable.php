<?php

namespace App\DataTables;

use App\Models\FotoRdo;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class FotosRDODatatable extends DataTable
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

        return $dataTable->addColumn('foto', function ($row) {
            return view('fotosRdo.showPhoto')->with([
                'UrlParaRelatorio' => $row->UrlParaRelatorio,
            ])->render();
        })->addColumn('action', 'fotosRdo.datatables_actions')->rawColumns(['foto', 'action']); 
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AtividadeRealizada $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FotoRdo $model)
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
            'id',
            'foto'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'fotosRdodatatable_'.time();
    }
}
