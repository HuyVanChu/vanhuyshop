<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\{Comment_Product, CommentBlog, Customers};
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function List()
    {
        $data['customers'] = Customers::orderBy('created_at', 'DESC')->where('state', '0')->get();
        return view('backend.eCommeerce.order.ecommerce-orders', $data);
    }
    public function Detail(Request $request, $id)
    {
        if ($request->tamp) {
            $data['tamp'] = 1;
        }
        $data['order'] = Customers::find($id);
        return view('backend.eCommeerce.order.ecommerce-detailorders', $data);
    }

    public function OrderSuccess($id)
    {
        $order = Customers::find($id);
        $order->state = '1';
        $order->save();
        return redirect()->route('admin_order_yes')->with('thong-bao-thanh-cong', 'Cập nhật trạng thái đơn hàng thành công');
    }
    public function Delete($id)
    {
        $order = Customers::find($id);
        $order->delete();
        return redirect()->route('admin_order_list')->with('thong-bao-thanh-cong', 'Xóa đơn hàng thành công');
    }
    public function Yes()
    {
        $data['customers'] = Customers::orderBy('created_at', 'DESC')->where('state', '1')->get();
        return view('backend.eCommeerce.order.order-yes', $data);
    }
    public function Search(Request $request)
    {
        if ($request->q) {
            $data['order'] = Customers::where('name', 'like', '%' . $request->q . '%')
                ->where('state', '=', '0')
                ->orwhere('id', '=', $request->q)
                ->paginate(15);
            $data['name'] = $request->q;
            $data['count'] = $data['order']->count();
        } elseif ($request->search) {
            $data['order'] = Customers::where('name', 'like', '%' . $request->q . '%')
                ->where('state', '=', '1')
                ->orwhere('id', '=', $request->q)
                ->paginate(15);
            $data['name'] = $request->q;
            $data['count'] = $data['order']->count();
        }
        return view('backend.eCommeerce.order.ecommerce-search-state0', $data);
    }
}
