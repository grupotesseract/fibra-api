<!-- Texto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('texto', 'Texto:') !!}
    {!! Form::text('texto', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}   &nbsp;
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!} Concluído
    </label>
</div>

{!! Form::hidden('manutencao_id', Request::get('manutencao_id', null), ['class' => 'form-control']) !!}


@if (isset($atividadeRealizada))
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('manutencoesCivilEletrica.show', $atividadeRealizada->manutencao_id) }}" class="btn btn-secondary">Cancelar</a>
</div>

@else
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('manutencoesCivilEletrica.show', Request::get('manutencao_id', null)) }}" class="btn btn-secondary">Cancelar</a>
</div>

@endif

