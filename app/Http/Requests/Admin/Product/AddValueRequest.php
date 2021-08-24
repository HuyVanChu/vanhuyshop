<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddValueRequest extends FormRequest
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
            'var_name'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'var_name.required' => 'Chưa nhập giá trị thuộc tính',
        ];
    }
}
