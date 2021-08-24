<?php

namespace App\Http\Requests\Site;

use Dotenv\Regex\Regex;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex as UnidataRegex;

class SignUpRequest extends FormRequest
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
            'phone'=>'required|numeric|unique:users,phone',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8|max:30',
            'check'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên',
            'phone.required' => 'Chưa nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại có kí tự đặc biệt',
            'phone.unique' => 'Số điện thoại đã được đăng kí',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được đăng kí',
            'password.required' => 'Chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu tối thiểu 8 kí tự',
            'password.max' => 'Mật khẩu tối đa 30 kí tự',
            'check.required' => 'Hãy đồng ý điều khoản',

        ];
    }
}
