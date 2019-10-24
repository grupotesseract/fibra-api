<?php

namespace App\Http\Requests;

use App\Models\Estoque;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEstoqueRequest extends FormRequest
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
        $rules = Estoque::$rules;

        return $rules;
    }
}
