<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Qrcode Field -->
<div class="form-group col-sm-6">
    {!! Form::label('qrcode', 'Qrcode') !!}
    {!! Form::text('qrcode', null, ['class' => 'form-control']) !!}
</div>

<!-- Circuito Field -->
<div class="form-group col-sm-6">
    {!! Form::label('circuito', 'Circuito') !!}
    {!! Form::select('circuito', ['Normal' => 'Normal', 'Emergência' => 'Emergência'], null, ['class' => 'form-control']) !!}
</div>

<!-- Planta Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('planta_id', 'Planta Id') !!}
    {!! Form::text('planta_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('itens.index') !!}" class="btn btn-default">Cancelar</a>
</div>
