
<!-- Tipo Material Id Field -->
@if (isset($material))

    <div class="form-group col-sm-6">
        @include('tipos_materiais.select', [
            'Model' => $material
        ])
    </div>    

    <div class="form-group col-sm-6">
        @include('potencias.select', [
            'Model' => $material
        ])
    </div>

    <div class="form-group col-sm-6">
        @include('tensoes.select', [
            'Model' => $material
        ])
    </div>

    <div class="form-group col-sm-6">
        @include('materiais.select_bases', [
            'Model' => $material
        ])
    </div>

    <div class="form-group col-sm-6">
        @include('materiais.select_reatores', [
            'Model' => $material
        ])
    </div>

@else

    <div class="form-group col-sm-6">
        @include('tipos_materiais.select')
    </div>    

    <div class="form-group col-sm-6">
        @include('materiais.select_reatores')
    </div>

    <div class="form-group col-sm-6">
        @include('materiais.select_bases')
    </div>

    <div class="form-group col-sm-6">
        @include('potencias.select')
    </div>

    <div class="form-group col-sm-6">
        @include('tensoes.select')
    </div>

@endif

<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nome', 'Nome') !!}
    {!! Form::text('nome', null, ['class' => 'form-control nomeMaterial', 
        'disabled' => isset($material) && !is_null($material->tipo_material_id) ?? false]) !!}
</div>

<!-- Nome Field -->
<div class="form-group col-sm-6">
    {!! Form::label('abreviacao', 'Abreviação') !!}
    {!! Form::text('abreviacao', null, ['class' => 'form-control abreviacaoMaterial', 
        'disabled' => isset($material->tipo_material_id) && !is_null($material->tipo_material_id) ?? false]) !!}
</div>

<!-- tipo_reator_qtde Reator Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tipo_reator_qtde', 'Tipo de Reator') !!}
    {!! Form::number('tipo_reator_qtde', null, ['class' => 'form-control tipoReator', 
        'disabled' => isset($material) && is_null($material->tipo_reator_qtde) ?? true]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('materiais.index') !!}" class="btn btn-default">Cancelar</a>
</div>

@section('scripts')
    <script src="/js/pages/Materiais.js"></script>
@endsection