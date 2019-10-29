<?php

namespace App\Http\Requests;

use App\Models\EntradaMaterial;
use Illuminate\Foundation\Http\FormRequest;

class CreateEntradaMaterialRequest extends FormRequest
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
        return EntradaMaterial::$rules;
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
            'quantidade.min' => 'A quantidade deve ser no mínimo 1',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro',
        ];
    }
}
