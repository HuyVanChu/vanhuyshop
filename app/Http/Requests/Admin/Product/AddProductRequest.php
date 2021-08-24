<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'trademark_id'=>'required',
            'name'=>'required|unique:products,name',
            'price'=>'required|numeric',
            'product_code'=>'required|unique:products,product_code',
            'info'=>'required',
            'featured'=>'required',
            'image' => 'mimes:png,jpeg,gif,jpg|max:2048',
            'image2' => 'mimes:png,jpeg,gif,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'trademark_id.required' => 'Chưa chọn thương hiệu',
            'name.required' => 'Chưa nhập tên sản phẩm',
            'name.unique' => 'Đã tồn tại sản phẩm',
            'price.required' => 'Chưa nhập giá sản phẩm',
            'price.numeric' => 'Định dạng giá không chính xác! Nó phải là số',
            'product_code.required' => 'Chưa nhập mã code sản phẩm',
            'product_code.unique' => 'Mã code sản phẩm đã tồn tại',

            'featured.required' => 'Hãy chọn sản phẩm nổi bật hoặc không, nó không được phép trống',
            'info.required' => 'Chưa viết giới thiệu',
            'image.mimes' => 'Định dạng ảnh không chính xác, hãy thử nó với một trong số kiểu png, jpeg, gif, jpg',
            'image.max' => 'Định dạng ảnh vượt quá 2MB điều này sẽ gây tốn tài nguyên của bạn',
            'image2.mimes' => 'Định dạng ảnh không chính xác, hãy thử nó với một trong số kiểu png, jpeg, gif, jpg',
            'image2.max' => 'Định dạng ảnh vượt quá 2MB điều này sẽ gây tốn tài nguyên của bạn',

        ];
    }
}
