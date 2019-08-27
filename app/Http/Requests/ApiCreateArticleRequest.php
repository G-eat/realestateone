<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiCreateArticleRequest extends FormRequest
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
            'title' => 'required|min:1|max:191',
            'body'  => 'required|min:1|max:480',
            'price' => 'required|min:1,integer',
            'address' => 'required|min:1|max:191',
            "city"=> "required|in:gjakove,prishtine,mitrovice,peje,prizren,gjilan,ferizaj",
            "for"=> "required|in:both,sale,rent",
            'phone_number' => 'required',
            "price"=> 'required|min:1,integer',
//            'filenames' => 'required|max:2048',
//            'filenames.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
