<?php

namespace App\DataTables;

use App\Models\QuantidadeMinima;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class QuantidadeMinimaDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'quantidades_minimas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\QuantidadeMinima $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(QuantidadeMinima $model)
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
            ->parameters(
                [
                    'dom'       => 'Bfrtip',
                    'stateSave' => true,
                    'order'     => [[0, 'desc']],
                    'buttons'   => [
                        ['extend' => 'export', 'text' => '<i class="fa fa-download"></i> Exportar', 'className' => 'btn btn-default btn-sm no-corner'],
                        ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i> Atualizar', 'className' => 'btn btn-default btn-sm no-corner'],
                        ['extend' => 'colvis', 'text'    => '<i class="fa fa-filter"></i> Filtrar Colunas'],
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
            'nome' => [
                'data' => 'material.nome',
                'title' => 'Nome',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
            ],
            'abreviacao' => [
                'data' => 'material.abreviacao',
                'title' => 'Abrev.',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
            ],
            'tipo_reator_qtde' => [
                'data' => 'material.tipo_reator_qtde',
                'title' => 'Qtde. Reator',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
            ],
            'tipoMaterialTipo' => [
                'data' => 'material.tipoMaterialTipo',
                'title' => 'Tipo',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'tipoMaterialNome' => [
                'data' => 'material.tipoMaterialNome',
                'title' => 'Tipo de Material',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'potenciaValor' => [
                'data' => 'material.potenciaValor',
                'title' => 'P(W)',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'tensaoValor' => [
                'data' => 'material.tensaoValor',
                'title' => 'T(V)',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'baseNome' => [
                'data' => 'material.baseNome',
                'title' => 'Base',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'reatorNome' => [
                'data' => 'material.reatorNome',
                'title' => 'Reator',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'quantidade_minima' => [
                'title' => 'Qtd.',
                'searchable' => true,
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
        return 'quantidades_minimasdatatable_'.time();
    }
}
