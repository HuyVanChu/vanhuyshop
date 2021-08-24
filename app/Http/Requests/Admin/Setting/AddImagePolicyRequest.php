<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class AddImagePolicyRequest extends FormRequest
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
