<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'=>'required',
            'creator'=>'required',
            'content'=>'required',
            'note'=>'required',
            'image'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Yêu cầu nhập tên danh mục'
        ];
    }
}
