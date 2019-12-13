import Axios from 'axios'

/**
 * @class ComentariosGerais
 */
class ComentariosGerais {

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
    $('#form-add-comentario-geral').on('submit', (event) => {
      event.preventDefault()
      this.submitFormAsync()
    });
  }

  /**
   * Limpa os campos do formulario
   */
  resetForm(inputComentario) {
    $(inputComentario).val('');
  }

  /**
   * Faz o submit do formulário de forma assíncrona
   */
  async submitFormAsync() {
    const url = location.href
    const container_erros = $("#container-erros");
    const comentario = $('#comentario');
    const programacao = $('#programacao_id');

    const data = {
      comentario : comentario.val(),
      programacao_id : programacao.val(),
    };

    container_erros.slideUp().html('');

    const result = await Axios.post(url, data)
      .then(response => {
        if (response.data.success){
          this.resetForm(comentario)
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

new ComentariosGerais
