<?php

namespace App\Http\Requests\API;

use App\Models\ComentarioGeral;
use InfyOm\Generator\Request\APIRequest;

class UpdateComentarioGeralAPIRequest extends APIRequest
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
        $rules = ComentarioGeral::$rules;

        return $rules;
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
            'comentario.required' => 'O campo comentário é obrigatório',
        ];
    }
}
