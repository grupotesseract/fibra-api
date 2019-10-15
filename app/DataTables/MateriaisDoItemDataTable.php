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
        return $dataTable->addColumn('quantidade', function($row) use ($itemID){
            return $row->items()->find($itemID)->pivot->quantidade_instalada;
        })->addColumn('action', function($row) use ($itemID){
            return view('itens.partials.form_remove_material')->with([
                'material_id' => $row->id,
                'item_id' => $itemID
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
        return $model->with('items');
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
            'nome',
            'tipoMaterialNome' => [
                'data' => 'tipoMaterialNome',
                'title' => 'Tipo de Material',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false
            ],
            'potenciaValor' => [
                'data' => 'potenciaValor',
                'title' => 'Potência',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false
            ],
            'tensaoValor' => [
                'data' => 'tensaoValor',
                'title' => 'Tensão',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false
            ],
            'quantidade' => [
                'title' => 'Quantidade',
                'searchable' => false,
                'orderable' => false,
                'filterable' => false
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
        return 'materiaisdatatable_'.time();
    }
}
