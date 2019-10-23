<?php

namespace App\Http\Requests;

use App\Models\QuantidadeSubstituida;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQuantidadeSubstituidaRequest extends FormRequest
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
        $rules = QuantidadeSubstituida::$rules;

        return $rules;
    }
}
