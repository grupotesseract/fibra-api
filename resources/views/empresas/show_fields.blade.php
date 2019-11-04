<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $empresa->id !!}</p>
</div>

<!-- Nome Field -->
<div class="form-group">
    {!! Form::label('nome', 'Nome:') !!}
    <p>{!! $empresa->nome !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $empresa->email !!}</p>
</div>

<!-- Telefone Field -->
<div class="form-group">
    {!! Form::label('telefone', 'Telefone:') !!}
    <p>{!! $empresa->telefone !!}</p>
</div>

<!-- Endereco Field -->
<div class="form-group">
    {!! Form::label('endereco', 'Endereço:') !!}
    <p>{!! $empresa->endereco !!}</p>
</div>

<!-- Cidade Id Field -->
<div class="form-group">
    {!! Form::label('cidade_id', 'Cidade:') !!}
    <p>{!! $empresa->cidade->nome !!}</p>
</div>

<div class="form-group">
    {!! Form::label('estado_id', 'Estado:') !!}
    <p>{!! $empresa->cidade->estado->nome !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em:') !!}
    <p>{!! $empresa->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em:') !!}
    <p>{!! $empresa->updated_at !!}</p>
</div>

