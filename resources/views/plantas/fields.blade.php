<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Endereco Field -->
<div class="form-group col-sm-6">
    {!! Form::label('endereco', 'Endereço') !!}
    {!! Form::text('endereco', null, ['class' => 'form-control']) !!}
</div>

<!-- Cidade Id Field -->
@if (isset($planta))

    <div class="form-group col-sm-6">
        @include('estados.select', [
            'Model' => $planta
        ])
    </div>
    <div class="form-group col-sm-6">
        @include('cidades.select', [
            'Model' => $planta
        ])
    </div>

@else

    <div class="form-group col-sm-6">
        @include('estados.select')
    </div>
    <div class="form-group col-sm-6">
        @include('cidades.select')
    </div>

@endif

<!-- Empresa Id Field -->
@if (isset($planta))

    <div class="form-group col-sm-6">
        @include('empresas.select', [
            'Model' => $planta
        ])
    </div>

@else

    <div class="form-group col-sm-6">
        @include('empresas.select')
    </div>

@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! url()->previous() !!}" class="btn btn-default">Cancelar</a>
</div>
