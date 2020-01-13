import Axios from 'axios'
import Swal from 'sweetalert2'

class Programacao {

  /**
   * @constructor
   */
  constructor() {
    this.eventHandlers()
    var URLRelatorio  = 'url para download';
  }

  /**
   * @returns
   */
  eventHandlers() {
    $('#download-relatorio-fotografico').on('submit', event => {
      event.preventDefault();
      this.URLRelatorio = event.target.action;
      this.submitDownloadAsync();
    })

    $('#download-relatorio-quantidades').on('submit', event => {
      event.preventDefault();
      this.URLRelatorio = event.target.action;
      this.submitDownloadAsync();
    })
  }

  /**
   * Metodo para fazer o download do relatorio de forma assincrona
   */
  async submitDownloadAsync() {
    this.mostraLoading();

    await Axios.post(this.URLRelatorio).then(response => {

      if (response.data.downloadURL) {
        this.escondeLoading()
        window.open(response.data.downloadURL)
      }

      else {
        //Se nao vier URL, tentar denovo em 5 segundos
        setTimeout(() => {this.submitDownloadAsync()}, 5000);
      }
    })
  }

  mostraLoading() {
    Swal.fire({
      html: '<p><i class="fa fa-spinner fa-spin fa-4x"></i></p><br><h5>Aguarde, gerando relatório...</h5> ',
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
      showConfirmButton: false
    })
  }

  escondeLoading() {
    Swal.close()
  }

}

new Programacao;
