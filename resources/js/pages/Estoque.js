import Axios from 'axios'

/**
 * @class Estoque
 */
class Estoque {

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
    $('#form-add-estoque').on('submit', (event) => {
      event.preventDefault()
      this.submitFormAsync()
    });
  }

  /**
   * Limpa os campos do formulario
   */
  resetForm(select_materiais, qnt_inicial, qnt_final) {
    $(select_materiais).val(0).trigger('change')
    $(qnt_inicial).val(0);
    $(qnt_final).val(0);
  }

  /**
   * Faz o submit do formulário de forma assíncrona
   */
  async submitFormAsync() {
    const url = location.href
    const container_erros = $("#container-erros");
    const programacao_id = $('#programacao_id').val();
    const select_materiais = $('#material_id');
    const qnt_inicial = $('#qnt_inicial');
    const qnt_final = $('#qnt_final');

    const data = {
      material_id : select_materiais.val(),
      programacao_id : programacao_id,
      quantidade_inicial : qnt_inicial.val(),
      quantidade_final : qnt_final.val(),
    };

    container_erros.slideUp().html('');

    const result = await Axios.post(url, data)
      .then(response => {
        if (response.data.success){
          this.resetForm(select_materiais, qnt_inicial, qnt_final)
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

new Estoque
