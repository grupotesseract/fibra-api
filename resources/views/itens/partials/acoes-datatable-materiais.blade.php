{!! Form::open(['route' => ['itens.desassociarMaterial', $item_id, $material_id], 'id' => 'form-desassociar-materiais', 'method' => 'delete']) !!}
<div class="row">

    <!-- Edit Field -->
    <div class="form-group ml-3 mt-1">
        <a href="{{ route('itens.materiais.edit', [$item_id, $material_id]) }}" class='btn btn-ghost-info'>
            <i class="fa fa-edit"></i>
        </a>
    </div>

    <!-- Delete Field -->
    <div class="form-group ml-3 mt-1">
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Você tem certeza que deseja excluir esse registro?')"
    ]) !!}
    </div>
</div>

{{ Form::close() }}

