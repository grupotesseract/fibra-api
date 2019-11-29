/**
 * @class Materiais
 */
class Materiais {

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
    $('.tipoMaterial').on('change', async event => {
      const id = event.currentTarget.value;
      const nomeCompleto = $(".tipoMaterial option:selected").text();
      const primeiroNome = nomeCompleto.replace(/ .*/,'');

      $('.nomeMaterial').prop('disabled', id.length > 0).prop('value', null);
      $('.abreviacaoMaterial').prop('disabled', id.length > 0).prop('value', null);
      $('.tipoReator').prop('disabled', primeiroNome != 'Reator').prop('value', null);
    })
  }

}

new Materiais
