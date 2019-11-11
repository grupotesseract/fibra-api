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

      $('.nomeMaterial').prop('disabled', id.length > 0).prop('value', null);
    })
  }

}

new Materiais
