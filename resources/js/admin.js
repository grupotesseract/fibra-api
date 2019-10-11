/**
 * JS incluso por padrão na blade layouts/app.blade.php
 */


$(function () {

  $('.select2').select2();

  $('#form-associar-materiais').submit((ev) => {
    ev.preventDefault();
    postAssociarMaterialItem();
  });
});


/**
 * postAssociarMaterialItem  - Faz o submit do formulario por ajax
 */
const postAssociarMaterialItem = () => {

  let url = location.href + "/materiais"
  let select_materiais = document.getElementById('material_id');
  let input_qnt = document.getElementById('qnt_instalada');
  let container_erros = $("#container-erros");
  let data = {
    material_id : select_materiais.value,
    qnt_instalada : input_qnt.value,
  };

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
  });

  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'json',
    data: $.param( data ),
    beforeSend: function () {
      container_erros.html('').hide();
    },
    success: function (data, textStatus, jqXHR) {
      resetFormAssociarItem(select_materiais, input_qnt);
      LaravelDataTables.dataTableBuilder.draw();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      $.each(jqXHR.responseJSON.errors, function (key, item) {
        container_erros.append("<p class=''>"+item+"</p>").slideDown();
      });
    }
  });
};

/**
 * resetFormAssociarItem - para limpar os campos do form de associar material ao item
 */
const resetFormAssociarItem = (select_materiais, input_qnt) => {
  $(select_materiais).val(0).trigger('change');
  input_qnt.value=0;
}

