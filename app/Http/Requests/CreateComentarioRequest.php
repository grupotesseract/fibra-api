<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Comentario;

class CreateComentarioRequest extends FormRequest
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
        return Comentario::$rules;
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
            'item_id.required' => 'O campo item é obrigatório',
            'item_id.exists' => 'O campo item é obrigatório',
            'comentario.required' => 'O campo comentário é obrigatório',
        ];
    }
}
