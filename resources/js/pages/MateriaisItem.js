import Axios from 'axios'

/**
 * @class MateriaisItem
 */
class MateriaisItem {

  /**
   * @constructor
   */
  constructor() {
    this.eventHandlers()
  }

  /**
   * @returns
   */
  eventHandlers() {
    $('.select2').select2();
    $('#form-associar-materiais').submit((event) => {
      event.preventDefault()
      this.postAssociarMaterialItem()
    });
  }

  static resetFormAssociarItem (select_materiais, input_qnt) {
    $(select_materiais).val(0).trigger('change')
    $(input_qnt).val(0);
  }

  postAssociarMaterialItem() {
    let url = location.href + "/materiais"
    let select_materiais = $('#material_id');
    let input_qnt = $('#qnt_instalada');
    let container_erros = $("#container-erros");
    let data = {
      material_id : select_materiais.val(),
      qnt_instalada : input_qnt.val(),
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
        console.log('success');
        MateriaisItem.resetFormAssociarItem(select_materiais, input_qnt);
        LaravelDataTables.dataTableBuilder.draw();
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $.each(jqXHR.responseJSON.errors, function (key, item) {
          container_erros.append("<p class=''>"+item+"</p>").slideDown();
        });
      }
    });
  }

}

new MateriaisItem
