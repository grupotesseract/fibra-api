<!-- Texto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto', 'Texto:') !!}
    {!! Form::text('texto', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!}
    </label>
</div>


<!-- Manutencao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('manutencao_id', 'Manutencao Id:') !!}
    {!! Form::text('manutencao_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('atividadesRealizadas.index') }}" class="btn btn-secondary">Cancel</a>
</div>
