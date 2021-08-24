<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'name'=>'required|unique:products,name,'.$this->id,
            'code'=>'required|unique:products,product_code,'.$this->id,
            'price'=>'required|numeric',

            'info'=>'required',
            'featured'=>'required|numeric',
            'image' => 'mimes:png,jpeg,gif,jpg|max:2048',
            'image2' => 'mimes:png,jpeg,gif,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'info.required' => 'Chưa viết giới thiệu',
            'name.required' => 'Chưa nhập tên sản phẩm',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'code.required' => 'Chưa nhập mã code sản phẩm',
            'code.unique' => 'Mã code sản phẩm đã tồn tại',
            'price.required' => 'Chưa nhập giá sản phẩm',
            'price.numeric' => 'Giá sản phẩm phải là số',
            
            'featured.required' => 'Chưa xác định sản phẩm nổi bật hay không',
            'featured.numeric' => 'Định dạng featured không chính xác, hãy thử nó với một số',
            'image.mimes' => 'Định dạng ảnh không chính xác, hãy thử nó với một trong số kiểu png, jpeg, gif, jpg',
            'image.max' => 'Định dạng ảnh vượt quá 2MB điều này sẽ gây tốn tài nguyên của bạn',
            'image2.mimes' => 'Định dạng ảnh không chính xác, hãy thử nó với một trong số kiểu png, jpeg, gif, jpg',
            'image2.max' => 'Định dạng ảnh vượt quá 2MB điều này sẽ gây tốn tài nguyên của bạn',




        ];
    }
}
