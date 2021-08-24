<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|mimes:png,jpeg,gif,jpg|max:4048|image',
        ];
    }
    public function messages()
    {
        return [
            'image.required' => 'Hãy chọn lại ảnh',
            'image.mimes' => 'Định dạng ảnh không chính xác, hãy thử nó với một trong số kiểu png, jpeg, gif, jpg',
            'image.max' => 'Định dạng ảnh vượt quá 4MB điều này sẽ gây tốn tài nguyên của bạn',
            'image.image' => 'Định dạng ảnh không chính xác',
        ];
    }
}
