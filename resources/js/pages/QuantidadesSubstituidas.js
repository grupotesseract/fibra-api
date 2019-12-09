import Axios from 'axios'

/**
 * @class QuantidadesSubstituidas
 */
class QuantidadesSubstituidas {

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
    $('#form-add-quantidades-substituidas').on('submit', (event) => {
      event.preventDefault()
      this.submitFormAsync()
    });
  }

  /**
   * Limpa os campos do formulario
   */
  resetForm(select_materiais, quantidade) {
    $(select_materiais).val(0).trigger('change')
    $(quantidade).val(0);
  }

  /**
   * Faz o submit do formulário de forma assíncrona
   */
  async submitFormAsync() {
    const url = location.href
    const container_erros = $("#container-erros");
    const programacao_id = $('#programacao_id').val();
    const item_id = $('#item_id').val();
    const select_materiais = $('#material_id');
    const quantidade = $('#quantidade');
    const data_manutencao = $('#data_manutencao');

    const data = {
      material_id : select_materiais.val(),
      programacao_id : programacao_id,
      item_id : item_id,
      quantidade_substituida : quantidade.val(),
      data_manutencao : data_manutencao.val(),
    };

    container_erros.slideUp().html('');

    const result = await Axios.post(url, data)
      .then(response => {
        if (response.data.success){
          this.resetForm(select_materiais, quantidade)
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

new QuantidadesSubstituidas
