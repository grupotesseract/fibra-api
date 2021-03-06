<?php

namespace App\DataTables;

use App\Models\Material;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class MateriaisDoItemDataTable extends DataTable
{
    public $itemID;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $itemID = $this->itemID;

        return $dataTable->addColumn('quantidade', function ($row) use ($itemID) {
            return $row->items()->find($itemID)->pivot->quantidade_instalada;
        })->addColumn('action', function ($row) use ($itemID) {
            return view('itens.partials.acoes-datatable-materiais')->with([
                'material_id' => $row->id,
                'item_id' => $itemID,
            ])->render();
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Material $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Material $model)
    {
        return $model->with(
            [
                'tipoMaterial' => function ($query) {
                    $query->orderBy('tipo')->orderBy('nome');
                },
            ]
        )->orderBy('nome');
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
                    'dom'       => 'frtip',
                    'stateSave' => true,
                    'order'     => [[0, 'desc']],
                    'buttons'   => [
                        ['extend' => 'reload', 'text' => '<i class="fa fa-refresh"></i> Atualizar', 'className' => 'btn btn-default btn-sm no-corner btnAtualizaDataTable'],
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
                'data' => 'nome',
                'title' => 'Nome',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'abreviacao' => [
                'data' => 'abreviacao',
                'title' => 'Abrev.',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'tipo_reator_qtde' => [
                'data' => 'tipo_reator_qtde',
                'title' => 'Qtde. Reator',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'tipoMaterialTipo' => [
                'data' => 'tipoMaterialTipo',
                'title' => 'Tipo',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'tipoMaterialNome' => [
                'data' => 'tipoMaterialNome',
                'title' => 'Tipo de Material',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'potenciaValor' => [
                'data' => 'potenciaValor',
                'title' => 'P(W)',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'tensaoValor' => [
                'data' => 'tensaoValor',
                'title' => 'T(V)',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'baseNome' => [
                'data' => 'baseNome',
                'title' => 'Base',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'reatorNome' => [
                'data' => 'reatorNome',
                'title' => 'Reator',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
            ],
            'quantidade' => [
                'title' => 'Qtde',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false,
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
        return 'materiaisdatatable_'.time();
    }
}
