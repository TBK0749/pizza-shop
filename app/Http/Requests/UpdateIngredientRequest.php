<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIngredientRequest extends FormRequest
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
            'name' => 'required|unique:ingredients|max:225',
            'price' => 'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => "Please enter a new ingredient name.",
            'name.unique' => "You are entering the same ingredient name as the existing one.",
            'name.max' => "You are entering a ingredient name exceeding 225 characters.",
            'price.required' => "Put price.",
        ];
    }
}
