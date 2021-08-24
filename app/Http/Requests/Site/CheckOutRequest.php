<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class CheckOutRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name'=>'required',
            'phone'=>'required|numeric',
            'email'=>'email',
            'address'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên',
            'phone.required' => 'Chưa nhập số điện thoại',
            'phone.numeric' => 'Điện thoại có kí tự đặc biệt',
            'email.email' => 'Email không đúng định dạng',
            'address.required' => 'Chưa nhập địa chỉ',

        ];
    }
}
