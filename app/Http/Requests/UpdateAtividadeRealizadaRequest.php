<?php

namespace App\Http\Requests;

use App\Models\AtividadeRealizada;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAtividadeRealizadaRequest extends FormRequest
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
        $rules = AtividadeRealizada::$rules;

        return $rules;
    }
}
