<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePizzaRequest extends FormRequest
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
            'name' => 'required|unique:pizzas|max:255',
            'ingredients' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg',
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
            'name.required' => "Please enter a new pizza name.",
            'name.unique' => "You are entering the same pizza name as the existing one.",
            'name.max' => "You are entering a pizza name exceeding 225 characters.",
            'ingredients.required' => "Please select ingredients.",
            'image.required' => "Please add an illustration.",
        ];
    }
}
