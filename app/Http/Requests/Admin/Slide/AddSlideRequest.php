<?php

namespace App\Http\Requests\Admin\Slide;

use Illuminate\Foundation\Http\FormRequest;

class AddSlideRequest extends FormRequest
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
            'image' => 'required|mimes:png,jpeg,gif,jpg|max:4048|image',
            'name' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'image.required' => 'Hãy chọn lại ảnh',
            'name.required' => 'Hãy chọn Title',
            'image.mimes' => 'Định dạng ảnh không chính xác, hãy thử nó với một trong số kiểu png, jpeg, gif, jpg',
            'image.max' => 'Định dạng ảnh vượt quá 4MB điều này sẽ gây tốn tài nguyên của bạn',
            'image.image' => 'Định dạng ảnh không chính xác',
        ];
    }
}
