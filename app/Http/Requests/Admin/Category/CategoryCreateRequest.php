<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
            'name_category'=>'required|unique:categories,name',
            'image_category' => 'mimes:png,jpeg,gif,jpg|max:2048',
            'icon_category' => 'mimes:png,jpeg,gif,jpg|max:2048'

        ];
    }
    public function messages()
    {
        return [
            'name_category.required' => 'Chưa nhập tên danh mục tên',
            'name_category.unique' => 'Đã tồn tại tên danh mục',
            'image_category.mimes' => 'Định dạng ảnh chưa chính xác: png, jpeg, gif, jpg',
            'image_category.max' => 'Kích cỡ ảnh vượt quá 2MB',
            'icon_category.mimes' => 'Định dạng ảnh chưa chính xác: png, jpeg, gif, jpg',
            'icon_category.max' => 'Kích cỡ ảnh vượt quá 2MB',
            ];
    }
}
