<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Login\LoginRequest;
use App\Http\Requests\Site\RequestPassword;
use App\Http\Requests\Site\SignUpRequest;
use App\Models\{Banner,Blogs,Categories,CommentBlog,Footers,Image_policy,Products,Contact,Setting,Trademaks,Users};
use App\Services\BlogService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Rules\Captcha;
use Validator;
class SiteController extends Controller
{
    private $blogservice;

    public function __construct(BlogService $blogservice)
    {
        $this->blogservice = $blogservice;
    }
    public function index()
    {
        //dd(Auth::guard('guest')->user());
        try {
            $data['categories'] = $this->blogservice->category_where();
            if ($data['categories']->count()>0) {
                $array1=array();
                $array2=array();
                foreach ($data['categories'] as $key => $value) {
                    if ($key % 3 != 0) {
                        $array1[] = $value;
                    } else {
                        $array2[] = $value;
                    }
                }
                if ($array1!=null) {
                    $data['array1'] = $array1;
                }

                $data['array2'] = $array2;
            }
            $data['product_new'] = Products::orderBy('created_at', 'DESC')->take(4)->get();
            $data['product_featured'] = Products::orderBy('created_at', 'DESC')->where('featured', '1')->get();
            $data['trademaks'] = Trademaks::all();
            $data['setting'] = Setting::where('state', '1')->first();
           // dd($data['setting']);
            $data['users_review'] = Users::where('state_review', '1')->get();
            return view('site.index.index', $data);
        } catch (ModelNotFoundException $exception) {
            return view('site.404.404');
        }

    }
    public function Contact()
    {
        $data['contact'] = Contact::find(1);
        return view('site.contact.contact',$data);
    }
    public function BlogList()
    {
        $data['blogs'] = Blogs::all();
        return view('site.index.blog.blog', $data);
    }
    public function ContentBlog($slug)
    {
        try {
            $data['blog'] = $this->blogservice->search_where($slug);
            $data['blog_take'] = Blogs::orderBy('created_at', 'DESC')->take(3)->get();
            return view('site.index.blog.blog_post', $data);
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('index');
        }
    }
    public function AddComment(Request $request, $id)
    {
        $commentBlog = new CommentBlog();
        $commentBlog->comnent = $request->comment;
        $commentBlog->blog_id = $id;
        $commentBlog->parent = '0';
        $commentBlog->state = '0';
        $commentBlog->user_id = Auth::guard('guest')->user()->id;
        $commentBlog->save();
        return redirect()->back();
    }

    public function SendReview()
    {
        $data['categories'] = Categories::where('cate_smail', '<>', '0')->get();
        foreach ($data['categories'] as $key => $value) {
            if ($key % 3 != 0) {
                $array1[] = $value;
            } else {
                $array2[] = $value;
            }
        }
        $data['array1'] = $array1;
        $data['array2'] = $array2;
        return view('site.index.review.form_review', $data);
    }
    public function SendReviewPost(Request $request)
    {
        $user = Users::find(Auth::guard('guest')->user()->id);
        $user->review = $request->comment;
        $user->save();
        return redirect()->back()->with('thong-bao', 'Chúng tôi đã tiếp nhận. Cảm ơn quý khách đã phản hồi');
    }
    public function SignUp()
    {
        return view('site.index.sign_up.sign_up');
    }
    public function SignUpPost(SignUpRequest $request)
    {
        if (strlen($request->phone) < 10 || strlen($request->phone) > 10) {
            return  redirect()->back()->withInput()->with('thong-bao-loi', 'Số điện thoại không đúng định dạng');
        }
        if ($request->password != $request->password_check) {
            return  redirect()->back()->withInput()->with('thong-bao-loi', 'Mật khẩu không khớp, hãy nhập lại');
        }
        $user = new Users();
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->phone = $request->phone;
        $user->email = lcfirst($request->email);
        $cal = preg_replace('/[^A-Za-z0-9\. -]/', '', $request->password);
        $user->password = Hash::make(preg_replace('/\s/', '', $cal));
        $user->save();
        return  redirect()->route('sigin_site');
    }
    public function SignIn()
    {
        return view('site.index.sign_up.gignin');
    }
    public function SignInPost(LoginRequest $request)
    {
        //dd($request->all());
        if ($request->remember_me) {
            $remember = $request->remember_me;
            if (Auth::guard('guest')->attempt([
                'email' => $request->name,
                'password' => $request->password
            ], $remember)) {
                return redirect()->route('index');
            } else {
                return redirect()->back()->withInput()->with('thongbao', 'Tài khoản khoặc mật khẩu không chính xác!');
            }
        } else {
            //dd(1);
            if (Auth::guard('guest')->attempt([

                'email' => $request->name,
                'password' => $request->password
            ])) {
                return redirect()->route('index');
            } else {
                return redirect()->back()->withInput()->with('thongbao', 'Tài khoản khoặc mật khẩu không chính xác!');
            }
        }
    }
    public function Logout()
    {
        Auth::guard('guest')->logout();
        return redirect()->route('index');
    }
    public function GetResetPassword()
    {
        return view('site.index.sign_up.resetpassword');
    }
    public function ResetPassword(RequestPassword $request)
    {
        $check=Users::where('email',$request->email)->first();
        if ($check) {
            $code=Str::random(6);
            Mail::send('site.index.sign_up.emailreset', $data=[
                'name'=> $check->name,
                'code'=>$code
            ], function ($message) use ($request,$code) {
                $message->from('orochimarusama767@gmail.com', 'Virginf');
                // $message->sender('john@johndoe.com', 'John Doe');
                $message->to($request->email);
                // $message->cc('john@johndoe.com', 'John Doe');
                // $message->bcc('john@johndoe.com', 'John Doe');
                // $message->replyTo('john@johndoe.com', 'John Doe');
                $message->subject('Mã đặt lại mật khẩu của bạn là: '.$code);
                // $message->priority(3);
                // $message->attach('pathToFile');
            });
            $data['code']=$code;
            $data['id_user']=$check->id;
            return view('site.index.sign_up.checkemail',$data);
        }else{
            return back()->with('thongbao','Email '.$request->email.' không tồn tại trên hệ thống')->withInput();
        }
    }

    public function CheckEmail(Request $request)
    {
        if ($request->code==$request->name) {
            $user=Users::find($request->id_user);
            $user->password=Hash::make($request->password);
            return redirect()->route('resetpasswordpost')->with('thong-bao','Đặt lại mật khẩu thành công');
        }else{
           return back()->with('thongbao','Mã code không đúng, hãy kiểm tra mã trong email của bạn');
        }

    }
    public function GetAddComment()
    {
        return back();
    }
    public function Error404()
    {
        return view('site.404.404');
    }
    public function error500()
    {
        return view('site.404.500');
    }
}
