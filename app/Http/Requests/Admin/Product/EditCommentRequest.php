<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class EditCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comment'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'comment.required' => 'Chưa nhập bình luận',
        ];
    }
}
