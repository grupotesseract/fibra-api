{!! Form::open(['route' => ['itens.desassociarMaterial', $item_id, $material_id], 'id' => 'form-desassociar-materiais', 'method' => 'delete']) !!}
<div class="row">

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-2">
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Você tem certeza que deseja excluir esse registro?')"
    ]) !!}
    </div>
</div>
{{ Form::close() }}

