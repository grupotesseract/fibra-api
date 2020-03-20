<?php

namespace App\DataTables;

use App\Models\ManutencaoCivilEletrica;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ManutencaoCivilEletricaDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'manutencoes_civil_eletrica.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ManutencaoCivilEletrica $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ManutencaoCivilEletrica $model)
    {
        return $model->with('planta')->newQuery();
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
            'obra_atividade',
            'equipe_cliente',            
            'data_hora_entrada',
            'data_hora_saida',
            'data_hora_inicio_lem',
            'data_hora_final_lem',
            'data_hora_inicio_let',
            'data_hora_final_let',
            'data_hora_inicio_atividades',
            'planta_id' => [
                'data' => 'planta.nome',
                'title' => 'Planta'
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'manutencoes_civil_eletricadatatable_' . time();
    }
}
