<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuantidadeMaterialItemRequest extends FormRequest
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
        return [
            'material_id' => 'required|exists:materiais,id',
            'quantidade_instalada' => 'required|integer|min:1',
        ];
    }

    /**
     * Incluindo mensagens amigaveis.
     *
     * @return void
     */
    public function messages()
    {
        return [
            'material_id.required' => 'O campo material é obrigatório',
            'material_id.exists' => 'O campo material é obrigatório',
            'quantidade_instalada.min' => 'A quantidade instalada deve ser no mínimo 1',
            'quantidade_instalada.integer' => 'A quantidade instalada deve ser um número inteiro',
        ];
    }
}
