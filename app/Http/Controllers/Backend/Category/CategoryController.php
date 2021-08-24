<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\{AttributeCreateRequest,CategoryCreateRequest,EditAttributeRequest,EditCategoryRequest};
use App\Models\{Categories,Properties,Trademaks};
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{Comment_Product, CommentBlog, Customers};

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    function Structure()
    {
        $data['categories'] = Categories::all();

        return view('backend.eCommeerce.category.category_structure', $data);
    }
    public function List()
    {
        $data['Categories'] = Categories::paginate(15);
        return view('backend.eCommeerce.category.categories', $data);
    }
    public function Chose()
    {
        $data['categories'] = Categories::where('parent', 0)->get();
        return view('backend.eCommeerce.category.chose_cat', $data);
    }
    public function ChosePost(Request $request)
    {
        if ($request->choose == '0') {
            return redirect()->route('admin_cat_create', ['slug' => 'tao-danh-muc-cha']);
        } else {
            $data['categories'] = Categories::find($request->choose);
            return redirect()
                ->route(
                    'admin_cat_choselevel',
                    [
                        'slug_cat' => $data['categories']->slug,
                        'name' => $data['categories']->name,
                        'id' => $data['categories']->id
                    ]
                );
        }
    }
    function ChoseLevel(Request $request, $slug)
    {
        $data['categories'] = Categories::all();
        $data['id'] = $request->id;
        $data['name'] = $request->name;
        $data['slug_cat'] = $slug;
        return view('backend.eCommeerce.category.choose_cat_level', $data);
    }
    function ChoseLevelPost(Request $request)
    {
        $category_check = Categories::find($request->choose);
        if ($category_check->properties->count() > 0) {
            return redirect()->back()->with('thong-bao', 'Đã tìm thấy thuộc tính của danh mục "' . $category_check->name . '" Hãy xóa và thử lại');
        } else {
            return redirect()->route('admin_cat_create', ['slug' => $category_check->slug, 'slug_cat' => $request->slug_cat, 'id' => $category_check->id]);
        }
    }
    public function Create(Request $request, $slug)
    {
        if ($slug == "tao-danh-muc-cha") {
            $data['Create_url_slug'] = $slug;
            //$data['trademarks'] = Trademaks::all();
            return view('backend.eCommeerce.category.create_category2', $data);
        } else {
            $data['trademarks'] = Trademaks::all();
            $data['id'] = $request->id;
            $data['check_choose'] = $request->slug_cat;
            return view('backend.eCommeerce.category.create_category', $data);
        }
    }
    function CreatePost(CategoryCreateRequest $request)
    {
        if (isset($request->Create_url_slug)) {
            $category = new Categories();
            $category->name = $request->name_category;
            $category->slug = Str::slug($request->name_category);
            $category->cate_smail = 0;

            if ($request->title_category) {
                $category->title = $request->title_category;
            } else {
                $category->title = $request->name_category;
            }

            $category->parent = 0;
            if ($request->image_category != '') {
                $image = $request->file('image_category');
                $nameValue = Str::slug($request->name_category);
                $nameImageValue = $nameValue . '.' . $image->extension();
                $file_old = public_path('category\\') . $nameImageValue;
                if (file_exists($file_old) != null) {
                    unlink($file_old);
                    $destinationPath = public_path('category\\');
                    $image->move($destinationPath, $nameImageValue);
                } else {
                    $destinationPath = public_path('category\\');
                    $image->move($destinationPath, $nameImageValue);
                }
                $category->image = $nameImageValue;
            } else {
                $category->image = 'no-img.jpg';
            }
            $category->save();
            return redirect()->route('admin_cat_list')->with('thong-bao-thanh-cong', 'Đã thêm thành công danh mục ' . $request->name_category);
        } else {
            $category = new Categories();
            $category->name = $request->name_category;
            $category->slug = Str::slug($request->name_category);
            $category->cate_smail = 0;
            if ($request->title_category) {
                $category->title = $request->title_category;
            } else {
                $category->title = $request->name_category;
            }
            $category->parent = $request->id;
            if ($request->image_category != '') {
                $image = $request->file('image_category');
                $nameValue = Str::slug($request->name_category);
                $nameImageValue = $nameValue . '.' . $image->extension();
                $file_old = public_path('category\\') . $nameImageValue;
                if (file_exists($file_old) != null) {
                    unlink($file_old);
                    $destinationPath = public_path('category\\');
                    $image->move($destinationPath, $nameImageValue);
                } else {
                    $destinationPath = public_path('category\\');
                    $image->move($destinationPath, $nameImageValue);
                }
                $category->image = $nameImageValue;
                $category->save();
                return redirect()->route('admin_cat_list')->with('thong-bao-thanh-cong', 'Đã thêm thành công danh mục ' . $request->name_category);

            } else {
                $category->image = 'no-img.jpg';
                $category->save();
                return redirect()->route('admin_cat_list')->with('thong-bao-thanh-cong', 'Đã thêm thành công danh mục ' . $request->name_category);

            }
        }
    }

    public function Edit(Request $request, $slug)
    {
        try {
            $data['category'] = $this->categoryService->search($request->cat_id);
            $data['parent'] = $request->parent;
            if ($data['category']->cate_smail == 1) {
                $data['properties'] = Properties::where('cat_id', $request->cat_id)->get();
            }
            $data['categories'] = Categories::all();
            $data['cat_id'] = $request->cat_id;
            $data['cate_smail'] = $data['category']->cate_smail;
            $data['id_CategoryChild2'] = $data['category']->id;
            $data['cat_name'] = $request->cat_name;
            return view('backend.eCommeerce.category.category_edit', $data);
        } catch (ModelNotFoundException $exception) {
            return view('backend.error.errors-404-error');
        }
    }
    function EditPost(EditCategoryRequest $request, $id)
    {
        $find = Categories::find($id);
        $Check_Propertes_Cat = $find->properties;
        if ($Check_Propertes_Cat->count() > 0 && $request->level == 0) {
            return redirect()->back()->with('thong-bao', 'Đã tìm thấy thuộc tính của danh mục "' . $find->name . '" Hãy xóa và thử lại');
        } else {
            $find->name = $request->name;
            $find->parent = $find->parent;
            if ($request->level == 1) {
                $ca = Categories::all();
                foreach ($ca as $value) {
                    if ($value->parent == $id) {
                        return redirect()->back()->with('thong-bao-loi', ' Đã tìm thấy cấp con của danh mục ' . $request->lavel . '! Hãy xóa nó và thử lại');
                    }
                }
            }
            $find->cate_smail = $request->level;
            if ($request->title != null) {
                $find->title = $request->title;
            } else {
                $find->title = $request->name;
            }
            if (isset($request->cate_smail)) {
                $find->cate_smail = $request->cate_smail;
            } else {
                $find->cate_smail = $request->level;
            }
            if ($request->image != '') {
                $file_old_del_file_cu = public_path('category\\') . $find->image;
                if (file_exists($file_old_del_file_cu) != null && $find->image != 'no-img.jpg') {
                    unlink($file_old_del_file_cu);
                }
                $image = $request->file('image');
                $nameValue = Str::slug($request->name);
                $nameImageValue = $nameValue . '.' . $image->extension();
                $file_old = public_path('category\\') . $nameImageValue;
                if (file_exists($file_old) != null) {
                    unlink($file_old);
                    $destinationPath = public_path('category\\');
                    $image->move($destinationPath, $nameImageValue);
                } else {
                    $destinationPath = public_path('category\\');
                    $image->move($destinationPath, $nameImageValue);
                }
                $find->image = $nameImageValue;
            } else {
                $find->image = $find->image;
            }

            $find->save();
            return redirect()->route('admin_cat_list')->with('thong-bao-thanh-cong', 'Đã cập nhật thành công danh mục ' . $request->name);
        }
    }
    function Delete(Request $request)
    {

        $category = Categories::find($request->id);
        $categories = Categories::all();
        foreach ($categories as $value) {
            if ($value->parent == $request->id) {
                return redirect()->back()->with('thong-bao-loi', 'Không thể xóa danh mục ' . $category->name . '! Đã tìm thấy danh mục con, Hãy xóa nó và thử lại');
            }
        }
        if ($category->products->count() > 0) {
            return redirect()->back()->with('thong-bao-loi', 'Không thể xóa danh mục ' . $category->name . '! Đã tìm thấy sản phẩm thuộc danh mục, Hãy xóa hết sản phẩm thuộc danh mục và thử lại');
        }
        $file_old_del_file_cu = public_path('category\\') . $category->image;
        if (file_exists($file_old_del_file_cu) != null) {
            if ($category->image!='no-img.jpg') {
                unlink($file_old_del_file_cu);
            }
        }
        $category->delete();
        return redirect()->route('admin_cat_list')->with('thong-bao-thanh-cong', 'Đã xóa thành công danh mục ' . $request->name);
    }
    // Attribute
    public function AddAttrPost(AttributeCreateRequest $request)
    {
        $propertie = new Properties();
        $propertie->column = $request->nameattr;
        $propertie->cat_id = $request->cat_id;
        $propertie->save();
        return redirect()->back()->with('thong-bao-thanh-cong', 'Thêm thành công ' . $request->name);
    }
    public function ListAttr($slug)
    {
        $data['slug_cat'] = $slug;
        $data['category'] = Categories::where('slug', $slug)->first();
        $data['properties'] = Properties::where('cat_id', $data['category']->id)->paginate(15);
        return view('backend.eCommeerce.category.list_attribute', $data);
    }
    public function EditAttr(Request $request, $name)
    {
        $data['propertie'] = Properties::where('column', $name)->first();
        $data['slug_cat'] = $request->slug_cat;
        return view('backend.eCommeerce.category.edit_attributecategory', $data);
    }
    public function EditAttrPost(EditAttributeRequest $request)
    {
        $propertie = Properties::find($request->id);
        $propertie->column = $request->name;
        $propertie->save();
        return redirect()->route('admin_attr_listattr', ['slug' => $request->slug_cat])->with('thong-bao-thanh-cong', 'Cập nhật thành công thuộc tính ' . $request->name);
    }
    public function DelAttr(Request $request, $id)
    {
        $propertie = Properties::find($id);
        $propertie->delete();
        return redirect()->route('admin_attr_listattr', ['slug' => $request->slug_cat])->with('thong-bao-xoa-thanh-cong', 'Xóa thành công thuộc tính ' . $request->column);
    }
}
