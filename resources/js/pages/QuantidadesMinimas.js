import Axios from 'axios'

/**
 * @class QuantidadesMinima
 */
class QuantidadesMinimas {

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
    $('#form-quantidades-minimas').on('submit', (event) => {
      event.preventDefault()
      this.submitForm()
    });
  }

  resetForm (select_materiais, input_qnt) {
    $(select_materiais).val(0).trigger('change')
    $(input_qnt).val(0);
  }

  async submitForm() {
    const url = location.href;
    const select_materiais = $('#material_id');
    const input_planta = $('#planta_id');
    const input_qnt = $('#qnt_minima');
    const container_erros = $("#container-erros");
    const data = {
      material_id : select_materiais.val(),
      quantidade_minima : input_qnt.val(),
      planta_id : input_planta.val(),
    };

    container_erros.slideUp().html('');

    const result = await Axios.post(url, data)
      .then(response => {
        if (response.data.success){
          this.resetForm(select_materiais, input_qnt)
          LaravelDataTables.dataTableBuilder.draw()
        }
      })
      .catch(response => {
        for (let [key, value] of Object.entries(response.response.data.errors)) {
          container_erros.append("<p class=''>"+value+"</p>").slideDown()
        }
      })
  }

}

new QuantidadesMinimas
