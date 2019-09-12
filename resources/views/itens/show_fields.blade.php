<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $item->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{!! $item->nome !!}</p>
</div>

<!-- Qrcode Field -->
<div class="form-group">
    {!! Form::label('qrcode', 'Qrcode:') !!}
    <p>{!! $item->qrcode !!}</p>
</div>

<!-- Circuito Field -->
<div class="form-group">
    {!! Form::label('circuito', 'Circuito:') !!}
    <p>{!! $item->circuito !!}</p>
</div>

<!-- Planta Id Field -->
<div class="form-group">
    {!! Form::label('planta_id', 'Planta Id:') !!}
    <p>{!! $item->planta_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $item->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $item->updated_at !!}</p>
</div>

