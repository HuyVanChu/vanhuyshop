<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            'name'=>'required|unique:categories,name,'.$this->id,
            'image'=>'mimes:png,jpeg,gif,jpg|max:2048',
            'imageicon'=>'mimes:png,jpeg,gif,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên',
            'name.unique'=>'Tên danh mục đã tồn tại!',
            'image.mimes' => 'Định dạng ảnh chưa chính xác: png, jpeg, gif, jpg',
            'image.max' => 'Kích cỡ ảnh vượt quá 2MB',
            'imageicon.mimes' => 'Định dạng ảnh chưa chính xác: png, jpeg, gif, jpg',
            'imageicon.max' => 'Kích cỡ ảnh vượt quá 2MB'

        ];
    }
}
