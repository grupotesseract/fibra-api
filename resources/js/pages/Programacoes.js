import Axios from 'axios'

/**
 * @class Programacoes
 */
class Programacoes {

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
    $('.datepicker').datetimepicker({
      format: 'DD/MM/YYYY HH:mm:ss',
      locale: 'pt-br',
      useCurrent: true,
      icons: {
        up: "icon-arrow-up-circle icons font-2xl",
        down: "icon-arrow-down-circle icons font-2xl"
      },
      sideBySide: true
    })
  }
}

new Programacoes
