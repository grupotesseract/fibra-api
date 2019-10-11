<div class="row">
    <!-- Select Materiais -->
    <div class="form-group col-sm-6">
        {!! Form::label('material', 'Material') !!}
        {!! Form::select('material_id', [''=>'Selecione um Material']+$materiais, null, ['class' => 'form-control  select2', 'id' => 'material_id']
        ) !!}
    </div>

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('quantidade_instalada', 'Qnt. instalada') !!}
        {!! Form::number('quantidade_instalada', null, ['class' => 'form-control', 'id' => 'qnt_instalada']) !!}
    </div>

    <!-- Quantidade Instalada Field -->
    <div class="form-group col-sm-2">
        {!! Form::button('<i class="fa fa-plus"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-success mt-4',
            'onclick' => 'postAssociarMaterialItem(this)',
        ]) !!}
    </div>
</div>


<script>
    const postAssociarMaterialItem = (el) => {

        let url = location.href + "/materiais"
        let data = {
            material_id : document.getElementById('material_id').value,
            qnt_instalada : document.getElementById('qnt_instalada').value,
        };

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: $.param( data ),
            complete: function (jqXHR, textStatus) {
                alert('completed');
                // callback
            },
            success: function (data, textStatus, jqXHR) {
                // success callback
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // error callback
            }
        });

    };
</script>

