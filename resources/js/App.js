import 'bootstrap'
import '@coreui/coreui'

/**
 *
 * @class App
 */
class App {

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
    }).on('dp.hide', function(e) {
        var dateTime = moment($(this).val(), "DD/MM/YYYY HH:mm:ss");
        var dateTimeAPI = moment(dateTime).format('YYYY-MM-DD HH:mm:ss');
        $(this).next('input[type=hidden]').val(dateTimeAPI);
      }
    );

  }
}

new App
