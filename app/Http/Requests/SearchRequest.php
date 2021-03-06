<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'price_from' => 'nullable|integer|lte:price_to|required_with:price_to',
            'price_to'   => 'nullable|integer|required_with:price_from'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'price_from.required_with:price_to' => 'The From field is required when To is present.',
            'price_to.required_with:price_from' => 'The To field is required when From is present.',
            'price_from.lte:price_to'           => 'Error',
            'price_to.integer'                  => 'Error',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'price_from' => '"From"',
            'price_to' => '"To"'
        ];
    }
}
