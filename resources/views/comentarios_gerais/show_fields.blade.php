<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $comentarioGeral->id }}</p>
</div>

<!-- Programacao Id Field -->
<div class="form-group">
    {!! Form::label('programacao_id', 'Programacao Id:') !!}
    <p>{{ $comentarioGeral->programacao_id }}</p>
</div>

<!-- Comentario Field -->
<div class="form-group">
    {!! Form::label('comentario', 'Comentario:') !!}
    <p>{{ $comentarioGeral->comentario }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $comentarioGeral->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $comentarioGeral->updated_at }}</p>
</div>

