<?php

namespace App\Http\Controllers\Site\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\AddCommentProduct;
use App\Models\{Banner,Categories,Comment_Product,Footers,Products,Setting,Values};
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function Search(Request $request)
    {
        $search =  $request->q;
        if ($search != "") {
            $data['product'] = Products::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
                ->paginate(12);
            $data['product']->appends(['q' => $search]);
            $data['name_search'] = $request->q;
            $data['count'] = $data['product']->count();
        } else {
            $data['name_search'] = $request->q;
            $data['product'] = Products::paginate(12);
            $data['count'] = $data['product']->count();
        }
        return view('site.index.product.product_search', $data);
    }
    public function ProductDetail($slug)
    {
        try {
            $data['product'] = $this->productService->search_where($slug);
            $data['product_new'] = Products::orderBy('created_at', 'DESC')->take(10)->get();
            return view('site.index.product.product_detail', $data);
        } catch (ModelNotFoundException $exception) {
            return redirect()->back();
        }
    }
    public function showprice(Request $request)
    {
        if ($request->login) {
            if ($request->attr) {
                foreach ($request->attr as $key => $value) {
                    if ($value == null) {
                        return redirect()->back()->with('thong-bao-loi','Hãy chọn thuộc tính sản phẩm và thử lại');
                    }
                }
                if ($request->quantity == 0 || $request->quantity < 0) {
                    return redirect()->back()->with('thong-bao-loi','Hãy chọn số lượng sản phẩm và thử lại');
                }
                try {
                    $product = $this->productService->search($request->id_product);
                    Cart::add(
                        [
                            'id' => $product->product_code,
                            'name' => $product->name,
                            'qty' => $request->quantity,
                            'price' => getprice2($product, $request->attr),
                            'weight' => 0,
                            'options' => ['img' => $product->image, 'attr' => $request->attr]
                        ]
                    );
                    return redirect()->route('cart.add');
                } catch (ModelNotFoundException $exception) {
                    return redirect()->back();
                }
            } else {
                if ($request->quantity == 0 || $request->quantity < 0) {
                    return redirect()->back();
                }
                try {
                    $product = $this->productService->search($request->id_product);
                    Cart::add(
                        [
                            'id' => $product->product_code,
                            'name' => $product->name,
                            'qty' => $request->quantity,
                            'price' => getprice2($product, $request->attr),
                            'weight' => 0,
                            'options' => ['img' => $product->image]
                        ]
                    );
                    return redirect()->route('cart.add');
                } catch (ModelNotFoundException $exception) {
                    return redirect()->back();
                }
            }
        } elseif ($request->register) {
            try {
                dd(1);
                $data['product'] = $this->productService->search($request->id_product);
                $data['price'] = getprice($data['product'], $request->attr);
                $data['banners'] = Banner::all();
                $data['product_new'] = Products::orderBy('created_at', 'DESC')->take(10)->get();
                return view('site.index.product.product_detail', $data);
            } catch (ModelNotFoundException $exception) {
                return redirect()->route('index');
            }
        }
        return redirect()->route('index');
    }
    public function UpdateCart($rowId, $qty)
    {
        Cart::update($rowId, $qty);
    }
    public function Shop(Request $request)
    {
        if ($request->danhmuc) {
            try {
                $data['category'] = $this->productService->search_where_category($request->danhmuc);
                $data['products'] = $data['category']->products()->paginate(12);
                $data['categories'] = Categories::where('cate_smail', '<>', '0')->get();
                $data['attribute'] = $data['category']->Attribute;
                if ($data['products']->count() > 0) {
                    $array = array();
                    foreach ($data['products'] as $value) {
                        $array[] = $value->price;
                    }
                    $data['max'] = max($array);
                    $data['min'] = min($array);
                } else {
                    $data['product_null'] = '1';
                }
                return view('site.index.product.product_shop', $data);
            } catch (ModelNotFoundException $exception) {
                return redirect()->back();
            }
        } else if ($request->danhmuc_attribute) {
            try {
                $data['categories'] = Categories::where('cate_smail', '<>', '0')->get();
                $data['category'] = $this->productService->search_where_category($request->danhmuc_attribute);
                $value = Values::find($request->thuoctinh);
                $data['products'] = $value->products()->paginate(12);
                $data['attribute'] = $data['category']->Attribute;
                foreach ($data['products'] as $value) {
                    $array[] = $value->price;
                }
                $data['max'] = max($array);
                $data['min'] = min($array);
                return view('site.index.product.product_shop', $data);

            } catch (ModelNotFoundException $exception) {
                return redirect()->back();
            }
        } else if ($request->submit_price) {
            try {
                $data['categories'] = $this->productService->search_cate_smail_category();
                $data['category'] = $this->productService->search_category($request->danhmuc_submit_price);
                $data['products'] = Products::whereBetween('price', [$request->start_price, $request->end_price])->where('cat_id', $request->danhmuc_submit_price)->paginate(12);
                $data['attribute'] = $data['category']->Attribute;
                $prd = $data['category']->products;
                $array = array();
                foreach ($prd as $value) {
                    $array[] = $value->price;
                }
                $data['max'] = max($array);
                $data['min'] = min($array);
                return view('site.index.product.product_shop', $data);
            } catch (ModelNotFoundException $exception) {
                return redirect()->back();
            }
        } else {
            try {
                $data['categories'] = $this->productService->search_cate_smail_category();
                $data['products'] = Products::paginate(9);
                return view('site.index.product.product_shop', $data);
            } catch (ModelNotFoundException $exception) {
                return redirect()->back();
            }
        }
    }
    public function AddComment(AddCommentProduct $request,$slug)
    {
        $commet_product=new Comment_Product();
        $commet_product->comment=$request->name;
        $commet_product->state='0';
        $commet_product->parent='0';
        $commet_product->use_id=Auth::guard('guest')->user()->id;
        $commet_product->prd_id=$request->product_id;
        $commet_product->save();
        return redirect()->back()->with('thong-bao','<div class="alert alert-sucsess">Cảm ơn quý khách, chúng tôi đã nhận được phản hồi từ bạn</div>');
    }
}
