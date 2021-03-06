<?php

namespace App\Http\Requests\API;

use App\Models\Estoque;
use InfyOm\Generator\Request\APIRequest;

class CreateEstoqueAPIRequest extends APIRequest
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
        return Estoque::$rules;
    }

    /**
     * Incluindo mensagens amigaveis.
     *
     * @return void
     */
    public function messages()
    {
        return [
            'programacao_id.required' => 'O campo programação é obrigatório',
            'programacao_id.exists' => 'O campo programação é obrigatório',
            'material_id.required' => 'O campo material é obrigatório',
            'material_id.exists' => 'O campo material é obrigatório',
            'quantidade_inicial.min' => 'A quantidade inicial deve ser no mínimo 1',
            'quantidade_inicial.integer' => 'A quantidade inicial deve ser um número inteiro',
            'quantidade_final.min' => 'A quantidade final deve ser no mínimo 1',
            'quantidade_final.integer' => 'A quantidade final deve ser um número inteiro',
        ];
    }
}
