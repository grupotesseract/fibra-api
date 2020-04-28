<?php

namespace App\DataTables;

use App\Models\ItemAlterado;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class ItemAlteradoDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'itens_alterados.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ItemAlterado $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ItemAlterado $model)
    {
        return $model->newQuery()->with(
            [
                'material',
                'item' => function ($query) {
                    $query->orderBy('qrcode');
                },
            ]
        );
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
            'qrcode' => [
                'data' => 'item.qrcode',
                'title' => 'QRCode',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
            ],
            'item' => [
                'data' => 'item.nome',
                'title' => 'Item',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
                'visible' => true,
            ],
            'nome' => [
                'data' => 'material.nome',
                'title' => 'Nome',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
            ],
            'abreviacao' => [
                'data' => 'material.abreviacao',
                'title' => 'Abreviação',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
            ],
            'tipo_reator_qtde' => [
                'data' => 'material.tipo_reator_qtde',
                'title' => 'Qtde. Tipo Reator',
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
                'title' => 'Potência',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'tensaoValor' => [
                'data' => 'material.tensaoValor',
                'title' => 'Tensão',
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
            'programacao_id' => [
                'title' => 'ID Programação',
                'searchable' => true,
                'orderable' => false,
                'filterable' => false,
                'visible' => false,
            ],
            'quantidade_instalada',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'itens_alteradosdatatable_'.time();
    }
}
