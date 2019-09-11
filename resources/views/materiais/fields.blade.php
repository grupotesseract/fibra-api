<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>

<!-- Potencia Field -->
<div class="form-group col-sm-6">
    {!! Form::label('potencia', 'Potência') !!}
    {!! Form::text('potencia', null, ['class' => 'form-control']) !!}
</div>

<!-- Tensao Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tensao', 'Tensao') !!}
    {!! Form::text('tensao', null, ['class' => 'form-control']) !!}
</div>

<!-- Tipo Material Id Field -->
@if (isset($tipos_materiais))

    <div class="form-group col-sm-6">
        @include('tipos_materiais.select', [
            'Model' => $material
        ])
    </div>    

@else

    <div class="form-group col-sm-6">
        @include('tipos_materiais.select')
    </div>    

@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('materiais.index') !!}" class="btn btn-default">Cancelar</a>
</div>
