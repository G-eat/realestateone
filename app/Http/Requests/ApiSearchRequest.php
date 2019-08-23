<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiSearchRequest extends FormRequest
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
            'price_from' => 'bail|nullable|integer|lte:price_to|required_with:price_to',
            'price_to'   => 'bail|nullable|integer|required_with:price_from'
        ];
    }
}
