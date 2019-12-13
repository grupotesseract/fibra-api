{!! Form::open(['route' => ['comentariosGerais.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('comentariosGerais.show', $id) }}" class='btn btn-ghost-success'>
       <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('comentariosGerais.edit', $id) }}" class='btn btn-ghost-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Remover esse comentário?')"
    ]) !!}
</div>
{!! Form::close() !!}
