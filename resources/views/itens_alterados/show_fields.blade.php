<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $itemAlterado->id }}</p>
</div>

<!-- Programacao Id Field -->
<div class="form-group">
    {!! Form::label('programacao_id', 'Programacao Id:') !!}
    <p>{{ $itemAlterado->programacao_id }}</p>
</div>

<!-- Item Id Field -->
<div class="form-group">
    {!! Form::label('item_id', 'Item Id:') !!}
    <p>{{ $itemAlterado->item_id }}</p>
</div>

<!-- Material Id Field -->
<div class="form-group">
    {!! Form::label('material_id', 'Material Id:') !!}
    <p>{{ $itemAlterado->material_id }}</p>
</div>

<!-- Quantidade Instalada Field -->
<div class="form-group">
    {!! Form::label('quantidade_instalada', 'Quantidade Instalada:') !!}
    <p>{{ $itemAlterado->quantidade_instalada }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $itemAlterado->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $itemAlterado->updated_at }}</p>
</div>

