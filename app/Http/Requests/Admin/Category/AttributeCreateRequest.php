<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class AttributeCreateRequest extends FormRequest
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
            'nameattr'=>'required|unique:properties,column',
        ];
    }
    public function messages()
    {
        return [
            'nameattr.required' => 'Chưa nhập tên',
            'nameattr.unique'=>'Thuộc tính đã tồn tại!',

        ];
    }
}
