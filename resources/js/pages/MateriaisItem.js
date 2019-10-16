import Axios from 'axios'

/**
 * @class MateriaisItem
 */
class MateriaisItem {

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
        $('#form-associar-materiais').submit((event) => {
            event.preventDefault()
            this.submitFormAddMaterialItem()
        });
    }

    resetFormAssociarItem (select_materiais, input_qnt) {
        $(select_materiais).val(0).trigger('change')
        $(input_qnt).val(0);
    }

    async submitFormAddMaterialItem() {
        const url = location.href + "/materiais"
        const select_materiais = $('#material_id');
        const input_qnt = $('#qnt_instalada');
        const container_erros = $("#container-erros");
        const data = {
            material_id : select_materiais.val(),
            qnt_instalada : input_qnt.val(),
        };

        container_erros.slideUp().html('');

        const result = await Axios.post(url, data)
            .then(response => {
                if (response.data.success){
                    this.resetFormAssociarItem(select_materiais, input_qnt)
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

new MateriaisItem
