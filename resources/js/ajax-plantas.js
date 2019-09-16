/**
 * JS para popular o select de plantas a partir do select de empresas
 */
$(function () {
  $('.ajax-plantas-empresa').on('change', function(ev){
    let empresaId = ev.currentTarget.value;
    $.ajax({
      url: '/empresas/'+empresaId+'/plantas',
      type: 'GET',
      dataType: 'json',
      success: function (data, textStatus, jqXHR) {
        let plantasHtml = '';
        for (let [key, value] of Object.entries(data.data)) {
          plantasHtml += '<option value="'+key+'">'+value+'</option>';
        }
        $('.select-plantas').html(plantasHtml);
      },
    });
  })
});
