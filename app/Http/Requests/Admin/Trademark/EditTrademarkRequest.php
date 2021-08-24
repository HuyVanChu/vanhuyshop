<?php

namespace App\Http\Requests\Admin\Trademark;

use Illuminate\Foundation\Http\FormRequest;

class EditTrademarkRequest extends FormRequest
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
            'name'=>'required|unique:trademarks,name,'.$this->id,
            'image' => 'mimes:png,jpeg,gif,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Chưa nhập tên',
            'name.unique'=>'Tên thương hiệu đã tồn tại!',
            'image.mimes' => 'Định dạng ảnh chưa chính xác: png, jpeg, gif, jpg',
            'image.max' => 'Kích cỡ ảnh vượt quá 2MB'

        ];
    }
}
