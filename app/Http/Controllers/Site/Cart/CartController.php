<?php

namespace App\Http\Controllers\Site\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Site\CheckOutRequest;
use App\Models\Attrs;
use App\Models\Banner;
use App\Models\Customers;
use App\Models\Footers;
use App\Models\OrderDetail;
use App\Models\Products;
use App\Models\Setting;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function Cart()
    {
        return view('site.index.cart.cart', $data);
    }
    public function AddCart(Request $request)
    {

        $data['cart'] = Cart::Content();
        $data['total'] = str_replace(',', '', Cart::subtotal()) + 40000;
        return view('site.index.cart.cart', $data);
    }
    public function DiscountCode(Request $request)
    {
        return redirect()->back()->with('thong-bao-loi','Mã giảm giá '.$request->discode.' không tồn tại');
    }
    public function GetDiscountCode()
    {
        return redirect()->back();
    }
    public function CheckOut(Request $request)
    {

        $data['cart'] = Cart::content();
        $data['total'] = str_replace(',', '', Cart::subtotal()) + 40000;
        return view('site.index.cart.checkout', $data);
    }
    public function CheckoutSuccess(CheckOutRequest $request)
    {
        $customer = new Customers();
        $customer->name = $request->name;
        $customer->slug = Str::slug($request->name);
        $customer->address = $request->address;

        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->total = Cart::total(0, '', '');
        $customer->state = 0;
        if ($request->note) {
            $customer->note = $request->note;
        }
        $customer->save();
        foreach (Cart::content() as $product) {
            $order = new OrderDetail();
            $order->name = $product->name;
            $order->price = $product->price;
            $order->quantity = $product->qty;
            $order->image = $product->options->img;
            $order->customer_id = $customer->id;
            $order->save();
            if ($product->options->attr) {
                foreach ($product->options->attr as $key => $value) {
                    $attr = new Attrs();
                    $attr->name = $key;
                    $attr->value = $value;
                    $attr->order_id = $order->id;
                    $attr->save();
                }
            }
        }


        $ord=Customers::find($customer->id)->OrderDetail;
        Mail::send('site.index.cart.sendmailcart', $data=[
            'name'=> $request->name,
            'ord'=>$ord,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'address'=>$request->address,
            'note'=>$request->note,
            'total'=>Cart::total(0, '', ''),
            'order_code'=>$order->id
        ], function ($message) use ($request) {
            $message->from('ahihi@gmail.com', 'HuyVan');
            // $message->sender('john@johndoe.com', 'John Doe');
            $message->to($request->email, $request->name);
            // $message->cc('john@johndoe.com', 'John Doe');
            // $message->bcc('john@johndoe.com', 'John Doe');
            // $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Xác nhận đơn hàng thành công');
            // $message->priority(3);
            // $message->attach('pathToFile');
        });
        Cart::destroy();
        return view('site.index.cart.checkout_success',$data);
    }
    public function RemoveCart($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
    public function AddCartShop($slug)
    {
        $product = Products::where('slug', $slug)->first();
        $qty = 1;
        Cart::add([
            'id' => $product->product_code,
            'name' => $product->name,
            'qty' => $qty,
            'price' => $product->price,
            'weight' => 0,
            'options' => ['img' => $product->image]
        ]);
        return redirect()->back();
    }
    public function AddNumber(Request $request)
    {
        Cart::update($request->rowId, $request->quantity);
        return back();
    }
    public function CheckoutSuccessGet()
    {
        return redirect()->route('index');
    }
}
