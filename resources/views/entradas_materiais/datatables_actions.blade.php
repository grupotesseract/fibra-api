{!! Form::open(['route' => ['entradasMateriais.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('entradasMateriais.edit', $id) }}" class='btn btn-ghost-info'>
       <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-ghost-danger',
        'onclick' => "return confirm('Remover essa entrada de material?')"
    ]) !!}
</div>
{!! Form::close() !!}
