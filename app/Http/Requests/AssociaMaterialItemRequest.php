<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociaMaterialItemRequest extends FormRequest
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
            'qnt_instalada' => 'required|integer|min:1'
        ];
    }

    /**
     * Incluindo mensagens amigaveis
     *
     * @return void
     */
    public function messages()
    {
        return [
            'material_id.required' => 'O campo material é obrigatório',
            'material_id.exists' => 'O campo material é obrigatório',
            'qnt_instalada.min' => 'A quantidade instalada deve ser no mínimo 1',
            'qnt_instalada.integer' => 'A quantidade instalada deve ser um número inteiro',
        ];
    }


}
