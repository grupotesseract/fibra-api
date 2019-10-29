{!! Form::open(['route' => ['estoque.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('estoque.edit', $id) }}" class='btn btn-ghost-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Remover esse registro de estoque?')"
    ]) !!}
</div>
{!! Form::close() !!}
