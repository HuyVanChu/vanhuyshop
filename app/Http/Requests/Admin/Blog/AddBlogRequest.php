<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogRequest extends FormRequest
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
            'title'=>'required|unique:blogs,title',
            'body' => 'required',
            'info' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Chưa nhập tên bài viết',
            'title.unique'=>'Tên bài viết đã tồn tại!',
            'image.max' => 'Định dạng ảnh vượt quá 4MB điều này sẽ gây tốn tài nguyên của bạn',
            'body.required' => 'Chưa nhập nội dung bài viết',
            'info.required' => 'Chưa nhập giới thiệu bài viết',
        ];
    }
}
