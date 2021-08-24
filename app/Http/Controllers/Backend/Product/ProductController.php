<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\{AddAttributeRequest,AddCommentRequest,AddProductRequest,AddValueRequest,EditAttributeRequet,EditCommentRequest,EditProductRequest,EditValueRequest,SearchProductRequest};
use App\Models\{Attributes,Categories,Comment_Product,CommentBlog,Customers,Image_Product,Products,Properties,Trademaks,ValueColumn,ValueProduct,Values,Variants};
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function List()
    {
        $data['products'] = Products::paginate(15);
        return view('backend.eCommeerce.product.ecommerce-products', $data);
    }
    function Choose()
    {
        $data['categories'] = Categories::all();
        return view('backend.eCommeerce.product.ecommerce-products-choose', $data);
    }
    function ChoosePost(Request $request)
    {
        try {
            $category = $this->productService->search_category($request->choose);
            if ($category->cate_smail == 0) {
                return redirect()->back()->with('thong-bao-loi', $category->name . ' là một danh mục cấp cao! Hãy chọn lại');
            } else {
                $data['category_id_choose'] = $category;
                return redirect()->route('admin_prd_create', ['cat_id' => $request->choose]);
            }
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    public function CreateProduct(Request $request)
    {
        try {
            $data['category'] = $this->productService->search_category($request->cat_id);
            $data['trademarks'] = Trademaks::all();
            $data['attribute'] = $data['category']->CategoriesAttribute;
            $data['cat_id'] = $request->cat_id;
            $data['cat_id_attr'] = $data['category'];
            $data['cat_name'] = $data['category']->name;
            $data['column'] = Properties::where('cat_id', $request->cat_id)->get();
            return view('backend.eCommeerce.product.ecommerce-add-new-product', $data);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    function CreateProductPost(AddProductRequest $request)
    {
        try {
            $category_find = $this->productService->search_category($request->cat_id);
            $product = new Products();
            $product->trademark_id = $request->trademark_id;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            if ($request->title) {
                $product->title = $request->title;
            } else {
                $product->title = $request->name;
            }
            $product->price = $request->price;
            $product->product_code = $request->product_code;
            $product->info = $request->info;
            $product->featured = $request->featured;
            $product->describer = $request->description;
            $product->cat_id = $request->cat_id;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $nameValue = Str::slug($request->name);
                $nameImageValue = $nameValue . '.' . $image->extension();
                if ($nameImageValue != 'no-img.jpg') {
                    $file_old = public_path('product\\') . $nameImageValue;
                    if (file_exists($file_old) != null) {
                        unlink($file_old);
                        $destinationPath = public_path('product\\');
                        $image->move($destinationPath, $nameImageValue);
                        $product->image = $nameImageValue;
                    } else {
                        $destinationPath = public_path('product\\');
                        $image->move($destinationPath, $nameImageValue);
                        $product->image = $nameImageValue;
                    }
                } else {
                    $product->image = $nameImageValue;
                }
            } else {
                $product->image = 'no-img.jpg';
            }
            if ($request->hasFile('image2')) {
                $image = $request->file('image2');
                $nameValue = Str::slug($request->name);
                $nameImageValue2 = $nameValue . '2.' . $image->extension();
                if ($nameImageValue2 != 'no-img.jpg') {
                    $file_old = public_path('product\\') . $nameImageValue2;
                    if (file_exists($file_old) != null) {
                        unlink($file_old);
                        $destinationPath = public_path('product\\');
                        $image->move($destinationPath, $nameImageValue2);
                        $product->image2 = $nameImageValue2;
                    } else {
                        $destinationPath = public_path('product\\');
                        $image->move($destinationPath, $nameImageValue2);
                        $product->image2 = $nameImageValue2;
                    }
                } else {
                    $product->image2 = $nameImageValue2;
                }
            } else {
                $product->image2 = 'no-img.jpg';
            }
            $product->save();
            // thêm dữ liệu vào bảng valuepropetie

            $proper = array();
            foreach ($category_find->properties as $value) {
                $proper[] = $value->id;
            }
            foreach ($proper as $column) {
                if ($request->propertie_id) {
                    $valuecolumn = new ValueColumn();
                    if ($request->$column == null) {
                        $valuecolumn->value = "Chưa có dữ liệu";
                    } else {
                        $valuecolumn->value = $request->$column;
                    }

                    $valuecolumn->properties_id = $column;
                    $valuecolumn->prd_id = $product->id;
                    $valuecolumn->save();
                }
            }

            // image detail
            if ($request->images) {
                $images = array();
                if ($files = $request->file('images')) {
                    foreach ($files as $file) {
                        $nameValue = Str::slug($request->name);
                        $nameImageValue3 = $nameValue . '-' . Str::random(2) . '.' . $file->extension();
                        if ($nameImageValue3 != 'no-img.jpg') {
                            $file_old = public_path('product\product_detail\\') . $nameImageValue3;
                            if (file_exists($file_old) != null) {
                                unlink($file_old);
                                $destinationPath = public_path('product\product_detail\\');
                            } else {
                                $destinationPath = public_path('product\product_detail\\');
                                $file->move($destinationPath, $nameImageValue3);
                            }
                        }
                        $images[] = $nameImageValue3;
                    }
                }
                foreach ($images as $value) {
                    Image_Product::insert([
                        'image' => $value,
                        'prd_id' => $product->id
                    ]);
                }
            }
            if ($request->attr) {
                // thêm dữ liệu vào bảng value_product
                $mang = array();
                foreach ($request->attr as $value) {
                    foreach ($value as $item) {
                        $mang[] = $item;
                    }
                }
                $product->values()->attach($mang);

                // Thêm biến thể cho sản phẩm
                // size:X color:blue ->id biến thể lưu ở bảng attribute.
                $variant = get_combinations($request->attr);
                foreach ($variant as $var) {
                    $vari = new Variants();
                    $vari->product_id = $product->id;
                    $vari->save();
                    $vari->values()->attach($var);
                }
                return redirect()->route('admin_prd_addpriceattr', ['slug' => $product->slug]);
            }
            return redirect()->route('admin_prd_list')->with('thong-bao', 'Đã thêm thành công sản phẩm ' . $request->name);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    function AddPriceAttr($slug)
    {
        try {
            $data['product'] = $this->productService->search_where($slug);
            $data['count'] = $data['product']->variant()->count();
            return view('backend.eCommeerce.product.ecommerce-add-price-attribute-product', $data);
        } catch (ModelNotFoundException $exception) {
            return view('backend.error.errors-404-error');
        }
    }
    function AddPriceAttrPost(Request $request)
    {
        foreach ($request->variant as $id => $price) {
            if ($price == null) {
                return redirect()->back()->with('thong-bao-loi', 'Chưa nhập giá cho biến thể');
            }
            $variantItem = Variants::find($id);
            $variantItem->price = $price;
            $variantItem->save();
        }
        return redirect()->route('admin_prd_list')->with('thong-bao-thanh-cong', 'Đã cập nhật giá thành công');
    }
    function DeleteAttr($id)
    {
        try {
            $variant = $this->productService->searchVariants($id);
            $variant->delete();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã xóa thành công biến thể');
        } catch (ModelNotFoundException $exception) {
            return view('backend.error.errors-404-error');
        }
    }
    public function EditProduct($slug)
    {
        $data['product'] = Products::where('slug', $slug)->first();
        $cat = Categories::where('id', $data['product']->cat_id)->first();
        $data['category_attribute'] = $cat->Attribute;
        $data['cat_id'] = $cat->id;
        $data['cat_name'] = $cat->name;
        $data['img_detail'] = $data['product']->productdetail;
        $data['trademarks'] = Trademaks::all();
        $data['categories'] = Categories::all();
        $data['value_column'] = $data['product']->value_column;
        return view('backend.eCommeerce.product.ecommerce-edit-products', $data);
    }
    function EditProductPost(EditProductRequest $request, $id)
    {
        $product = Products::find($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        if ($request->title) {
            $product->title = $request->title;
        } else {
            $product->title = $request->name;
        }
        $product->product_code = $request->code;
        $product->price = $request->price;

        $product->featured = $request->featured;
        $product->info = $request->info;
        $product->trademark_id = $request->trademark_id;
        $product->cat_id = $request->cat_id;
        $product->describer = $request->describer;
        if ($request->image != null) {
            $file_old = public_path('product\\') . $product->image;
            if (file_exists($file_old) != null && $product->image != 'no-img.jpg') {
                unlink($file_old);
            }
            $file = $request->file('image');
            $nameValue = Str::slug($request->name);
            $nameImageValue = $nameValue . '-' . Str::random(2) . '.' . $file->extension();
            $destinationPath = public_path('product\\');
            $file->move($destinationPath, $nameImageValue);
            $product->image = $nameImageValue;
        } else {
            $product->image = $product->image;
        }
        if ($request->image2 != null) {
            $file_old = public_path('product\\') . $product->image2;
            if (file_exists($file_old) != null && $product->image != 'no-img.jpg') {
                unlink($file_old);
            }
            $file = $request->file('image2');
            $nameValue_2 = Str::slug($request->name);
            $nameImageValue_2 = $nameValue_2 . '-' . Str::random(2) . '.' . $file->extension();
            $destinationPath = public_path('product\\');
            $file->move($destinationPath, $nameImageValue_2);
            $product->image2 = $nameImageValue_2;
        } else {
            $product->image2 = $product->image2;
        }
        // image detail
        if ($request->images) {
            $images = array();
            if ($files = $request->file('images')) {
                foreach ($files as $file) {
                    $nameValue_4 = Str::slug($request->name);
                    $nameImageValue_3 = $nameValue_4 . '-' . Str::random(5) . '.' . $file->extension();
                    $destinationPath_detail = public_path('product/product_detail\\');
                    $file->move($destinationPath_detail, $nameImageValue_3);
                    $images[] = $nameImageValue_3;
                }
            }
            foreach ($images as $value) {
                Image_Product::insert([
                    'image' => $value,
                    'prd_id' => $product->id
                ]);
            }
        }

        if ($request->attr) {
            /** n-n
             * Thêm: Attach
             * - Đối tượng xác định -> liên kết n-n -> Attach(biến)
             * Sửa :Sync
             *  - Đối tượng xác định -> liên kết n-n -> Sync(biến)
             * Xóa tất cả: Detach
             * - Đối tượng xác định -> liên kết n-n -> Detach(biến)
             * Biế có thể là 1 mảng hay 1 giá trị
             */
            $mang3 = array();
            foreach ($request->attr as $value) {
                foreach ($value as $item) {
                    $mang3[] = $item;
                }
            }
            $product->values()->Sync($mang3);

            //add variant
            $variant = get_combinations($request->attr);
            foreach ($variant as $var) {
                if (check_var($product, $var)) {
                    $vari = new Variants();
                    $vari->product_id = $product->id;
                    $vari->save();
                    $vari->values()->Attach($var);
                }
            }
            $product->save();
            return redirect()->route('admin_prd_addpriceattr', ['slug' => $product->slug]);
        } else {
            $product = Products::find($id);
            $product->values()->detach();
            $variant = Variants::where('product_id', $id)->get();
            foreach ($variant as $variant_value) {
                $variant_value->delete();
            }
        }
        if ($request->image2) {
            $product->image2 = $nameImageValue_2;
        }
        if ($request->image) {
            $product->image = $nameImageValue;
        }
        if ($request->value_column_id) {
            foreach ($request->value_column_id as $value) {
                $update_value_col = ValueColumn::find($value);

                if ($request->$value == null) {
                    $update_value_col->value = "Chưa có dữ liệu";
                } else {
                    $update_value_col->value = $request->$value;
                }
                $update_value_col->save();
            }
        }
        $product->save();
        return redirect()->route('admin_prd_list')->with('thong-bao-thanh-cong', 'Cập nhật thành công sản phẩm ' . $request->name);
    }
    function DeleteProduct(Request $request, $id)
    {
        $product = Products::find($id);
        $file_old = public_path('product\\') . $product->image;
        if (file_exists($file_old) != null && $product->image != 'no-img.jpg') {
            if ($product->image2 != "no-img.jpg") {
                unlink($file_old);
            }
        }
        $file_old_image2 = public_path('product\\') . $product->image2;
        if (file_exists($file_old_image2) != null) {
            if ($product->image != "no-img.jpg") {
                unlink($file_old_image2);
            }
        }
        foreach ($product->productdetail as $valueImageDetail) {
            $file_old3 = public_path('product\product_detail\\') . $valueImageDetail->image;
            if (file_exists($file_old3) != null) {
                if ($valueImageDetail->image != 'no-img.jpg') {
                    unlink($file_old3);
                }
            };
        }
        Products::destroy($id);
        return redirect()->back()->with('thong-bao-thanh-cong', 'Đã xóa thành công sản phẩm ' . $request->name);
    }
    function EditImageDetailProductPost(Request $request, $id)
    {
        $product = Products::find($request->prd_id);
        $images = array();
        foreach ($product->productdetail as $imageDetail) {
            if ($request->imageDetail_id == $imageDetail->id) {
                $images[] = $imageDetail->id;
            }
        }
        foreach ($images as $value) {
            if ($request->$value) {
                $file_old = public_path('product\product_detail\\') . $request->imageDetail_name;
                if (file_exists($file_old) != null && $request->imageDetail_name != 'no-img.jpg') {
                    unlink($file_old);
                }
                $image_item = $request->file($value);
                $nameImageValue_3 = $product->slug . '-' . Str::random(2) . '.' . $image_item->extension();

                $destinationPath = public_path('product/product_detail\\');
                $image_item->move($destinationPath,  $nameImageValue_3);
                $image_detai = Image_Product::find($request->imageDetail_id);
                $image_detai->image = $nameImageValue_3;
                $image_detai->prd_id = $request->prd_id;
                $image_detai->save();
            }
        }
        return redirect()->back()->with('thong-bao-thanh-cong', 'Đã cập nhật ảnh thành công');
    }
    function DeleteImageDetailProductPost($id)
    {
        $imageDetail = Image_Product::find($id);
        $file_old = public_path('product\product_detail\\') . $imageDetail->image;
        if (file_exists($file_old) != null && $imageDetail->image != 'no-img.jpg') {
            unlink($file_old);
        }
        $imageDetail->delete();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Đã xóa ảnh thành công');
    }
    // value
    function AddValuePost(AddValueRequest $request)
    {
        $attribute = new Values();
        $attribute->value = $request->var_name;
        $attribute->slug = Str::slug($request->var_name);
        $attribute->attr_id = $request->id_attr;
        $attribute->save();
        return redirect()->back()->with('thong-bao-add-attribute-success', 'Thêm thành công ' . $request->var_name);
    }
    function EditValuePost(EditValueRequest $request)
    {
        $value = Values::find($request->value_id);
        $value->value = $request->namevalue;
        $value->slug = Str::slug($request->namevalue);
        $value->attr_id = $request->attr_id;
        $value->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Sửa thành công ' . $request->namevalue);
    }
    function DeleteValuePost(Request $request, $id)
    {
        $value = Values::find($id);
        $value->delete();
        return redirect()->back()->with('thong-bao-xoa-thanh-cong', 'Xóa thành công ' . $request->name);
    }
    // attr
    function AddAttrPost(AddAttributeRequest $request)
    {
        $category = Categories::find($request->id_cat);
        foreach ($category->Attribute as $value) {
            if ($value->name == $request->attr_name) {
                return redirect()->back()->with('thong-bao-loi', 'Đã tồn tại thuộc tính ' . $request->attr_name);
            }
        }
        $attribute = new Attributes();
        $attribute->name = $request->attr_name;
        $attribute->slug = Str::slug($request->attr_name);
        $attribute->cat_id = $request->id_cat;
        $attribute->save();
        return redirect()->back()->with('thong-bao-add-attribute-success', 'Thêm thành công ' . $request->attr_name);
    }
    function ListAttr(Request $request)
    {
        $data['cat_name'] = $request->cat_name;
        $data['cat_id_url'] = $request->cat_id;
        $data['category'] = Categories::find($request->cat_id)->CategoriesAttribute;
        return view('backend.eCommeerce.product.ecommerce-list-atribute', $data);
    }
    function EditAttributePost(EditAttributeRequet $request, $id)
    {
        $attribute = Attributes::find($id);
        $attribute->name = $request->name;
        $attribute->slug = Str::slug($request->name);
        $attribute->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Đã cập nhật thành công thuộc tính ' . $request->name);
    }
    function DelAttr(Request $request, $slug)
    {
        $attribute = Attributes::where('slug', $slug)->first();
        $attribute->delete();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Đã xóa thành công thuộc tính ' . $request->name);
    }
    function DetailProduct($slug)
    {
        $data['product'] = Products::where('slug', $slug)->first();
        $cat_id = $data['product']->cat_id;
        $data['category'] = Categories::find($cat_id);
        return view('backend.eCommeerce.product.ecommerce-detail-product', $data);
    }
    function SearchProduct(SearchProductRequest $request)
    {
        $data['products'] = Products::where('name', 'like', '%' . $request->name . '%')
            ->orwhere('id', '=', $request->name)
            ->paginate(15);
        $data['name'] = $request->name;
        $data['count'] = $data['products']->count();
        return view('backend.eCommeerce.product.ecommerce-search-product', $data);
    }
    function Comment()
    {
        $data['comment_products'] = Comment_Product::where('state', '0')->paginate(20);
        return view('backend.eCommeerce.product.ecommerce-list-comment-product', $data);
    }
    function CommentPost(AddCommentRequest $request)
    {
        if ($request->add_cmt_da_rep) {
            $cmt = new Comment_Product();
            $cmt->comment = $request->comment;
            $cmt->use_admin_id = Auth::user()->id;
            $cmt->state = 1;
            $cmt->parent = $request->id_cmt_con;
            $cmt->prd_id = $request->prd_id;
            $cmt->name_user_comment = $request->name_user_comment;
            $cmt->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã trả lời bình luận');
        } else {
            $cmt_find = Comment_Product::find($request->commen_id);
            $cmt_find->state = 1;
            $cmt_find->save();
            $cmt = new Comment_Product();
            $cmt->comment = $request->comment;
            $cmt->use_admin_id = $request->product_id;
            $cmt->state = 1;
            $cmt->parent = $request->id;
            $cmt->prd_id = $request->commen_prd_id;
            $cmt->name_user_comment = $request->name_user;
            $cmt->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã trả lời bình luận');
        }
    }
    public function DaXuLy()
    {
        $data['comment_products'] = Comment_Product::where('state', '1')->paginate(20);
        $data['comment_products_admin'] = Comment_Product::where('use_id', null)->get();
        return view('backend.eCommeerce.product.ecommerce-success-comment-product', $data);
    }
    public function DaXuLyPost(EditCommentRequest $request)
    {
        if ($request->add_cmt_da_rep) {
            $cmt = Comment_Product::find($request->comment_id);
            $cmt->comment=$request->comment;
            $cmt->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã cập nhật bình luận thành công');
        }
        else{
            $cmt = Comment_Product::find($request->comment_id);
            $cmt->comment = $request->comment;
            $cmt->save();
            return redirect()->route('admin_cmt_ok')->with('thong-bao-thanh-cong', 'Đã cập nhật bình luận thành công');
        }

    }
    public function remove(Request $request, $id)
    {

        foreach (Comment_Product::all() as $value) {
            if ($value->parent == $id) {
                $value->delete();
            }
        }
        $cmt_find = Comment_Product::find($id);
        $cmt_find->delete();
        if ($request->admin) {
            return redirect()->route('admin_cmt_ok')->with('thong-bao', 'Đã xóa bình luận thành công');
        } else {
            return redirect()->route('admin_cmt_product')->with('thong-bao', 'Đã xóa bình luận thành công');
        }
    }
}
