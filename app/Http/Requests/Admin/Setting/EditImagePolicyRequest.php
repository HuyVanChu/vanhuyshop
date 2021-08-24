<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class EditImagePolicyRequest extends FormRequest
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
            'icon' => 'required',
            'content' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'icon.required' => 'Hãy chọn lại icon',
            'content.required' => 'Hãy chọn lại nội dung',
        ];
    }
}
