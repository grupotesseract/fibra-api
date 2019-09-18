<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id') !!}
    <p>{!! $tensao->id !!}</p>
</div>

<!-- Valor Field -->
<div class="form-group">
    {!! Form::label('valor', 'Valor') !!}
    <p>{!! $tensao->valor !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Criado em') !!}
    <p>{!! $tensao->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Atualizado em') !!}
    <p>{!! $tensao->updated_at !!}</p>
</div>

