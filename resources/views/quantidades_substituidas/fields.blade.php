<!-- Programacao Id Field -->
{{ Form::hidden('programacao_id', null)}}

<!-- Item Id Field -->
{{ Form::hidden('item_id', null)}}

<!-- Planta Id Field -->
{{ Form::hidden('material_id', null)}}

<!-- Quantidade Substituida Field -->
<div class="form-group col-sm-3">
    {!! Form::label('quantidade_substituida', 'Quantidade Substituida:') !!}
    {!! Form::text('quantidade_substituida', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12" style="min-height:150px"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! url()->previous() !!}" class="btn btn-default">Cancelar</a>
</div>

