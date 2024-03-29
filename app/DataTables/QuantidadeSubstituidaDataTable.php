<?php

namespace App\DataTables;

use App\Models\QuantidadeSubstituida;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class QuantidadeSubstituidaDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'quantidades_substituidas.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\QuantidadeSubstituida $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(QuantidadeSubstituida $model)
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
            ->addAction(['width' => '120px', 'printable' => false, 'title'=>'Ações'])
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
            'quantidade_substituida' => [
                'data' => 'quantidade_substituida',
                'title' => 'Qnt. Substituída',
                'searchable' => true,
                'orderable' => true,
                'filterable' => false,
                'visible' => true,
            ],
            'quantidade_substituida_base' => [
                'data' => 'quantidade_substituida_base',
                'title' => 'Qnt. Substituída Base',
                'searchable' => true,
                'orderable' => true,
                'filterable' => false,
                'visible' => true,
            ],
            'quantidade_substituida_reator' => [
                'data' => 'quantidade_substituida_reator',
                'title' => 'Qnt. Substituída Reator',
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
        return 'quantidades_substituidasdatatable_'.time();
    }
}
