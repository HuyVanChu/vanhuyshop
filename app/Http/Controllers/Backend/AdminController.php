<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\{Comment_Product,CommentBlog,Customers, Users};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    public function Index()
    {
        $data['total_order'] = Customers::where('state', 0)->count();
        $data['total_cmt_blog'] = CommentBlog::where('state', 0)->count();
        $data['total_cmt_product'] = Comment_Product::where('state', 0)->count();
        //dd($data['total_cmt_product']);
        $data['total_notif'] = ($data['total_order']+$data['total_cmt_blog']+$data['total_cmt_product'] );
        //dd($data['total_cmt_product']);
        // doanh thu theo ngày
        $data['total_many_day'] = Customers::where('state','1')->whereDate('updated_at', date('Y-m-d'))->get()->sum('total');
        // doanh thu theo tháng
        $data['currentMonth']=Carbon::now()->format('m');
        $data['total_Month']=Customers::where('state',1)->whereMonth('updated_at',$data['currentMonth'])->get()->sum('total');
        // doanh thu theo năm
        $data['currentYear']=Carbon::now()->format('Y');
        $data['total_Year']=Customers::where('state',1)->whereYear('updated_at',$data['currentYear'])->get()->sum('total');
        // doanh thu tuần
        $data['total_Week']=Customers::where('state',1)->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get()->sum('total');
        // review customer product
        $data['cmt_product']=Comment_Product::where('state',0)->orderBy('created_at', 'DESC')->take(20)->get();
        // order
        $data['orders']=Customers::where('state',0)->take(20)->get();
        //dd($data['cmt_product']);
        return view('backend.index', $data);
    }
    public function error404()
    {
        return view('backend.error.errors-404-error');
    }
    public function error500()
    {
        return view('backend.error.500');
    }
}
