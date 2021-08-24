<?php

namespace App\Http\Controllers\Backend\Trademark;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Trademark\{CreateTrademarkRequest, EditTrademarkRequest};
use App\Models\Trademaks;
use App\Services\TrademarkService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{Comment_Product,CommentBlog,Customers};
class TrademarkController extends Controller
{
    private $trademarkService;

    public function __construct(TrademarkService $trademarkService)
    {
        $this->trademarkService = $trademarkService;
    }
    public function List()
    {
        $data['trademarks'] = Trademaks::paginate(15);
        return view('backend.eCommeerce.trademark.trademarkList', $data);
    }
    public function Create()
    {
        return view('backend.eCommeerce.trademark.trademarkCreate', $data);
    }
    public function CreatePost(CreateTrademarkRequest $request)
    {
        $trademark = new Trademaks();
        $trademark->name = $request->name;
        $trademark->slug = Str::slug($request->name);
        if ($request->title) {
            $trademark->title = $request->title;
        } else {
            $trademark->title = $request->name;
        }
        if ($request->image != '') {
            $image                      = $request->file('image');
            $nameValue                      = Str::slug($request->name);
            $nameImageValue                      = $nameValue . '.' . $image->extension();
            $file_old = public_path('trademark\\') . $nameImageValue;
            if (file_exists($file_old) != null) {
                unlink($file_old);
                $destinationPath            = public_path('trademark\\');
                $image->move($destinationPath, $nameImageValue);
            } else {
                $destinationPath            = public_path('trademark\\');
                $image->move($destinationPath, $nameImageValue);
            }
            $trademark->image = $nameImageValue;
        } else {
            $trademark->image = 'no-img.jpg';
        }
        $trademark->save();
        return redirect()->route('admin_trademark_list')->with('thong-bao-thanh-cong', 'Đã thêm thành công thương hiệu' . $request->name);
    }
    public function Edit($slug)
    {
        try {
            $data['trademark'] = $this->trademarkService->search_where($slug);
            return view('backend.eCommeerce.trademark.trademarkEdit', $data);
        } catch (ModelNotFoundException $exception) {
            return view('backend.error.errors-404-error');
        }
    }
    public function EditPost(EditTrademarkRequest $request, $id)
    {
        /**
         * Xóa, xóa ảnh cũ trong thư mục
         * Nếu chọn ảnh = ảnh no-img. gán tên ảnh = no-img
         * Nếu không có hành động sửa ảnh, lấy ảnh ban đầu
         */
        $trademark = Trademaks::find($id);
        $trademark->name = $request->name;
        $trademark->slug = Str::slug($request->name);
        $trademark->title = $request->title;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nameValue = Str::slug($request->name);
            $nameImageValue = $nameValue . '.' . $image->extension();
            if ($nameImageValue != 'no-img.jpg') {
                $file_old = public_path('trademark\\') . $trademark->image;
                //dd($file_old);
                if (file_exists($file_old) != null) {
                    if ($trademark->image != 'no-img.jpg') {
                        unlink($file_old);
                    }

                    $destinationPath = public_path('trademark\\');
                    $image->move($destinationPath, $nameImageValue);
                    $trademark->image = $nameImageValue;
                } else {
                    $destinationPath = public_path('trademark\\');
                    $image->move($destinationPath, $nameImageValue);
                    $trademark->image = $nameImageValue;
                }
            } else {
                $trademark->image = $nameImageValue;
            }
        } else {
            $trademark->image = $trademark->image;
        }
        $trademark->save();
        return redirect()->route('admin_trademark_list')->with('thong-bao-thanh-cong', 'Đã sửa thành công thương hiệu ' . $request->name);
    }
    function Delete($slug)
    {
        try {
            $trademark = $this->trademarkService->search_where($slug);
            if ($trademark->products->count() > 0) {
                return redirect()->route('admin_trademark_list')->with('thong-bao-loi', 'Đã tìm thấy sản phẩm thuộc thương hiệu ' . $trademark->name . '! Hãy xóa sản phẩm thuộc thương hiệu và thử lại');
            }
            $file_old = public_path('trademark\\') . $trademark->image;
            if (file_exists($file_old) != null) {
                if ($trademark->image != 'no-img.jpg') {
                    unlink($file_old);
                }
            }
            $trademark->delete();
            return redirect()->route('admin_trademark_list')->with('thong-bao-thanh-cong', 'Đã xóa thành công thương hiệu ' . $trademark->name);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
}
