<?php

namespace App\Http\Requests\Site;

use App\Rules\Captcha;
use Illuminate\Foundation\Http\FormRequest;

class RequestPassword extends FormRequest
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
     * https://vietlaravel.com/huong-dan-tich-hop-google-recaptcha-v2-vao-laravel.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }
    public function messages()
    {
        return [
            'email.email' => 'Email không đúng định dạng',
            'email.required' => 'Email trống',
            'g-recaptcha-response.required' => 'Mã Captcha không hợp lệ',
        ];
    }
}
