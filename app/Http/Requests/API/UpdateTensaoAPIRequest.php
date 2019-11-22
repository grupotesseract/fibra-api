<?php

namespace App\Http\Requests\API;

use App\Models\Tensao;
use InfyOm\Generator\Request\APIRequest;

class UpdateTensaoAPIRequest extends APIRequest
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
        $rules = Tensao::$rules;        
        $rules['valor'] .= ','.$this->route('tenso');
        return $rules;
    }
}
