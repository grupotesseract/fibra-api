{!! Form::open(['route' => ['datasManutencoes.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('datasManutencoes.show', $id) }}" class='btn btn-ghost-success'>
       <i class="fa fa-eye"></i>
    </a>    
</div>
{!! Form::close() !!}
