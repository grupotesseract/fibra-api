<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $quantidadeSubstituida->id !!}</p>
</div>

<!-- Quantidade Substituida Field -->
<div class="form-group">
    {!! Form::label('quantidade_substituida', 'Quantidade Substituida:') !!}
    <p>{!! $quantidadeSubstituida->quantidade_substituida !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em:') !!}
    <p>{!! $quantidadeSubstituida->created_at->format('d/m/Y H:i:s') !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em:') !!}
    <p>{!! $quantidadeSubstituida->updated_at->format('d/m/Y H:i:s') !!}</p>
</div>

