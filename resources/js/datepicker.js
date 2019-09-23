/**
 * JS para popular o select de cidades a partir do select de estados
 */
$(function () {
  $('.datepicker').datetimepicker({
    format: 'DD/MM/YYYY HH:mm',
    locale: 'pt-br',
    useCurrent: true,
    icons: {
        up: "icon-arrow-up-circle icons font-2xl",
        down: "icon-arrow-down-circle icons font-2xl"
    },
    sideBySide: true
  })
});
