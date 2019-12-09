<!-- Programacao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programacao_id', 'Programacao Id:') !!}
    {!! Form::text('programacao_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_id', 'Item Id:') !!}
    {!! Form::text('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Material Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('material_id', 'Material Id:') !!}
    {!! Form::text('material_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantidade Substituida Field -->
<div class="form-group col-sm-3">
    {!! Form::label('quantidade_substituida', 'Quantidade Substituida:') !!}
    {!! Form::text('quantidade_substituida', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Inicio Real Field -->
<div class="form-group col-sm-3">
    {!! Form::label('data_manutencao', 'Data da Manutenção') !!}
    {!! Form::text('data_manutencao', null, ['class' => 'datepicker form-control','id'=>'data_manutencao']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('quantidadesSubstituidas.index') !!}" class="btn btn-default">Cancelar</a>
</div>
