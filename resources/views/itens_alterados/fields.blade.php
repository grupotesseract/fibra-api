{{-- <!-- Programacao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programacao_id', 'Programacao Id:') !!} --}}
    {!! Form::hidden('programacao_id', null, ['class' => 'form-control']) !!}
{{-- </div> --}}

{{-- <!-- Item Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_id', 'Item Id:') !!} --}}
    {!! Form::hidden('item_id', null, ['class' => 'form-control']) !!}
{{-- </div> --}}

<!-- Material Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('material_id', 'Material Id:') !!} --}}
    {!! Form::hidden('material_id', null, ['class' => 'form-control']) !!}
{{-- </div> --}}

<!-- Quantidade Instalada Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantidade_instalada', 'Quantidade Instalada:') !!}
    {!! Form::text('quantidade_instalada', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('itensAlterados.index') }}" class="btn btn-secondary">Cancelar</a>
</div>
