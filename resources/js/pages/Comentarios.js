import Axios from 'axios'

/**
 * @class Comentarios
 */
class Comentarios {

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
    $('#form-add-comentario').on('submit', (event) => {
      event.preventDefault()
      this.submitFormAsync()
    });
  }

  /**
   * Limpa os campos do formulario
   */
  resetForm(select_itens, inputComentario) {
    $(select_itens).val(0).trigger('change')
    $(inputComentario).val('');
  }

  /**
   * Faz o submit do formulário de forma assíncrona
   */
  async submitFormAsync() {
    const url = location.href
    const container_erros = $("#container-erros");
    const inputItemId = $('#item_id');
    const comentario = $('#comentario');
    const programacao = $('#programacao_id');

    const data = {
      item_id : inputItemId.val(),
      comentario : comentario.val(),
      programacao_id : programacao.val(),
    };

    container_erros.slideUp().html('');

    const result = await Axios.post(url, data)
      .then(response => {
        if (response.data.success){
          this.resetForm(inputItemId, comentario)
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

new Comentarios
