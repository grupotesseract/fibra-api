import Axios from 'axios'
import Swal from 'sweetalert2'

class Programacao {

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
    $('#download-relatorio-fotografico').on('submit', async event => {
      event.preventDefault();
      Swal.fire({
        html: '<p><i class="fa fa-spinner fa-spin fa-4x"></i></p><br><h5>Aguarde, gerando relatório...</h5> ',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        showConfirmButton: false
      })
    })
  }

}

new Programacao;
