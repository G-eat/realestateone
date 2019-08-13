<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' => 'required|max:191',
            'body'  => 'required',
            'price' => 'required',
            'phone_number' => 'required',
            'filenames' => 'max:2048',
            'filenames.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
