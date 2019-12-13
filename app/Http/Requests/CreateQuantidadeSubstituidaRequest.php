<?php

namespace App\Http\Requests;

use App\Models\QuantidadeSubstituida;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuantidadeSubstituidaRequest extends FormRequest
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
        return QuantidadeSubstituida::$rules;
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
            'material_id.exists' => 'O valor do campo material já existe',
            'item_id.required' => 'O campo item é obrigatório',
            'item_id.exists' => 'O campo item é obrigatório',

            'quantidade_substituida.min' => 'A quantidade substituida deve ser no mínimo 1',
            'quantidade_substituida.integer' => 'A quantidade substituida deve ser um número inteiro',
        ];
    }
}
