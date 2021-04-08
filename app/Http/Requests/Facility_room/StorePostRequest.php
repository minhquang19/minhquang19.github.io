<?php

namespace App\Http\Requests\Facility_room;

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
            'room_id'=>'required',
            'facility_id'=>'required',
            'facility_name'=>'required',
            'amount'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'room_id.required'=>'Yêu cầu nhập tên danh mục'
        ];
    }
}
