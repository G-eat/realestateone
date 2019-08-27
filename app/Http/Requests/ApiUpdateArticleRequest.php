<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiUpdateArticleRequest extends FormRequest
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
            'title' => 'min:1|max:191',
            'body'  => 'min:1|max:480',
            'address' => 'min:1|max:191',
            "city"=> "in:gjakove,prishtine,mitrovice,peje,prizren,gjilan,ferizaj",
            "for"=> "in:both,sale,rent",
            "price"=> 'min:1,integer',
            "views"=> 'integer',
            "type"=> "in:1+1,2+1,3+1,3+2,4+1,4+2,5+1",
            "available"=> 'in:1,0',
            'filenames' => 'max:2048',
            'filenames.*' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }
}
