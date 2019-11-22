<?php

namespace App\Http\Requests\API;

use App\Models\Potencia;
use InfyOm\Generator\Request\APIRequest;

class UpdatePotenciaAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Potencia::$rules;
        $rules['valor'] .= ','.$this->route('potencia');

        return $rules;
    }
}
