<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentBlogRequest extends FormRequest
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
            'comment'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'comment.required' => 'Chưa nhập nội dung comment',
        ];
    }
}
