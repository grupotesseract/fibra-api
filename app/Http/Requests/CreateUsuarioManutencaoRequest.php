<?php

namespace App\Http\Requests;

use App\Models\UsuarioManutencao;
use Illuminate\Foundation\Http\FormRequest;

class CreateUsuarioManutencaoRequest extends FormRequest
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
        return UsuarioManutencao::$rules;
    }
}
