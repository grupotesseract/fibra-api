<!-- Programacao Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('programacao_id', 'Programacao Id:') !!}
    {!! Form::text('programacao_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Data Hora Field -->
<div class="form-group col-sm-6">
    {!! Form::label('data_hora', 'Data Hora:') !!}
    {!! Form::text('data_hora', null, ['class' => 'form-control','id'=>'data_hora']) !!}
</div>

@section('scripts')
   <script type="text/javascript">
           $('#data_hora').datetimepicker({
               format: 'YYYY-MM-DD HH:mm:ss',
               useCurrent: true,
               icons: {
                   up: "icon-arrow-up-circle icons font-2xl",
                   down: "icon-arrow-down-circle icons font-2xl"
               },
               sideBySide: true
           })
       </script>
@endsection

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('liberacoesDocumentos.index') !!}" class="btn btn-default">Cancel</a>
</div>
