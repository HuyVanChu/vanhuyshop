<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class EditFooterRequest extends FormRequest
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
            'title' => 'required',
            'content' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Hãy viết nội dung title cho website của bạn',
            'content.required' => 'Hãy viết nội dung chân trang cho website của bạn',
        ];
    }
}
