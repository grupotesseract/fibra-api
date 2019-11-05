<?php

namespace App\Http\Requests;

use App\Models\QuantidadeMinima;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuantidadeMinimaRequest extends FormRequest
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
        return QuantidadeMinima::$rules;
    }

    /**
     * Incluindo mensagens amigaveis.
     *
     * @return void
     */
    public function messages()
    {
        return [
            'planta_id.required' => 'O campo planta é obrigatório',
            'planta_id.exists' => 'O campo planta é obrigatório',
            'material_id.required' => 'O campo material é obrigatório',
            'material_id.exists' => 'O campo material é obrigatório',
            'quantidade_minima.min' => 'A quantidade deve ser no mínimo 1',
            'quantidade_minima.integer' => 'A quantidade deve ser um número inteiro',
        ];
    }
}
