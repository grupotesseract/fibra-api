<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id') !!}
    <p>{!! $planta->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome') !!}
    <p>{!! $planta->nome !!}</p>
</div>

<!-- Endereco Field -->
<div class="form-group">
    {!! Form::label('endereco', 'Endereço') !!}
    <p>{!! $planta->endereco !!}</p>
</div>

<!-- Cidade Id Field -->
<div class="form-group">
    {!! Form::label('cidade_id', 'Cidade:') !!}
    <p>{!! $planta->cidade->nome !!}</p>
</div>

<!-- Empresa Id Field -->
<div class="form-group">
    {!! Form::label('empresa_id', 'Empresa') !!}
    <p>{!! $planta->empresa->nome !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em') !!}
    <p>{!! $planta->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em') !!}
    <p>{!! $planta->updated_at !!}</p>
</div>

