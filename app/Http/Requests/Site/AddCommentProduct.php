<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentProduct extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Bạn muốn đánh giá? Hãy viết nố và thử lại',
        ];
    }
}
