import Axios from 'axios'

/**
 * @class Plantas
 */
class Plantas {

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
    $('.select-plantas-empresa').on('change', async event => {
      let content = '';
      const ID = event.currentTarget.value;
      const result = await Axios.get(`/empresas/${ID}/plantas`)

      for (let [key, value] of Object.entries(result.data)) {
        content += `<option value="${key}">${value}</option>`;
      }

      $('.select-plantas-empresa').html(content);
    })
  }

}

new Plantas
