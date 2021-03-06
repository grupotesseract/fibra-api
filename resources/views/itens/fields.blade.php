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
<!-- Empresa Id Field -->
@if (isset($item))

    <div class="form-group col-sm-6">
        @include('plantas.select', [
            'Model' => $item
        ])
    </div>

@else

    <div class="form-group col-sm-6">
        @include('plantas.select')
    </div>

@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! url()->previous() !!}" class="btn btn-default">Cancelar</a>
</div>
