<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SloganRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'slogan' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'slogan.required' => 'Hãy viết Slogan cho website của bạn',
        ];
    }
}
