<?php
namespace App\Services;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Variants;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductService
{

    public function search($id)
    {
        $product = Products::find($id);
        if (!$product) {
            throw new ModelNotFoundException('Không tìm thấy sản phẩm có ID ' . $id);
        }
        return $product;
    }
    public function search_where($slug)
    {
        $product = Products::where('slug', $slug)->first();
        if (!$product) {
            throw new ModelNotFoundException('Có một lỗi ngoại lệ khi truyền slug');
        }
        return $product;
    }
    public function search_product($slug)
    {
        $product = Products::where('name', 'like', '%'.$slug.'%')->paginate(2);
        if (!$product) {
            throw new ModelNotFoundException('Có một lỗi ngoại lệ khi truyền slug');
        }
        return $product;
    }
    public function search_category($id)
    {
        $search_category_1 = Categories::find($id);
        if (!$search_category_1) {
            throw new ModelNotFoundException('Dữ liệu đầu vào khôn chính xác');
        }
        return $search_category_1;
    }
    public function searchVariants($id)
    {
        $search_variants = Variants::find($id);
        if (!$search_variants) {
            throw new ModelNotFoundException('Không tìm thấy biến thể có ID ' . $id);
        }
        return $search_variants;
    }
    public function search_where_category($danhmuc)
    {
        $search_where_category = Categories::where('slug', $danhmuc)->first();
        if (!$search_where_category) {
            throw new ModelNotFoundException('Dữ liệu đầu vào khôn chính xác');
        }
        return $search_where_category;
    }
    public function search_cate_smail_category()
    {
        $search_cate_smail_category_1 = Categories::where('cate_smail', '<>', '0')->get();
        if (!$search_cate_smail_category_1) {
            throw new ModelNotFoundException('Dữ liệu đầu vào khôn chính xác');
        }
        return $search_cate_smail_category_1;
    }
}
?>
