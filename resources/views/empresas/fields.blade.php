<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome:') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Telefone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telefone', 'Telefone:') !!}
    {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
</div>

<!-- Endereco Field -->
<div class="form-group col-sm-6">
    {!! Form::label('endereco', 'Endereço:') !!}
    {!! Form::text('endereco', null, ['class' => 'form-control']) !!}
</div>

<!-- Endereco Field -->
<div class="form-group col-sm-6">
    {!! Form::label('path_imagem', 'URL para Logo:') !!}
    {!! Form::text('path_imagem', null, ['class' => 'form-control']) !!}
</div>

@if (isset($empresa))

    <div class="form-group col-sm-6">
        @include('estados.select', [
            'Model' => $empresa
        ])
    </div>
    <div class="form-group col-sm-6">
        @include('cidades.select', [
            'Model' => $empresa
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('empresas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
