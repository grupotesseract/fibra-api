<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id') !!}
    <p>{!! $item->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome') !!}
    <p>{!! $item->nome !!}</p>
</div>

<!-- Qrcode Field -->
<div class="form-group">
    {!! Form::label('qrcode', 'Qrcode') !!}
    <p>{!! $item->qrcode !!}</p>
</div>

<!-- Circuito Field -->
<div class="form-group">
    {!! Form::label('circuito', 'Circuito') !!}
    <p>{!! $item->circuito !!}</p>
</div>

<!-- Planta Id Field -->
<div class="form-group">
    {!! Form::label('planta_id', 'Planta:') !!}
    <p>{!! $item->planta->nome !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em') !!}
    <p>{!! $item->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em') !!}
    <p>{!! $item->updated_at !!}</p>
</div>

