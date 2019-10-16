import $ from 'jquery';
import 'select2'
import 'eonasdan-bootstrap-datetimepicker'

/**
 * @class Admin
 */
class Admin {

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
    $('.select2').select2();
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

new Admin
