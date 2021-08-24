<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'name'=>'required|unique:admin_user,name,'.$this->id,
            'email'=>'required|unique:admin_user,email,'.$this->id,
            'phone'=>'required|numeric',
            'address'=>'required',
            'image'=>'mimes:png,jpeg,gif,jpg|max:2048',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên',
            'name.unique' => 'Tên quản trị đã tồn tại',
            'email.required' => 'Chưa nhập email',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Chưa nhập số điẹn thoại',
            'phone.numeric' => 'Số điẹn thoại không đúng định dạng',
            'address.required' => 'Chưa nhập địa chỉ',
            'image.mimes' => 'Định dạng ảnh chưa chính xác: png, jpeg, gif, jpg',
            'image.max' => 'Kích cỡ ảnh vượt quá 2MB',
        ];
    }
}
