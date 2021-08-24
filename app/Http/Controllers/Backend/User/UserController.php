<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\AddUserRequest;
use App\Http\Requests\Admin\User\EditUserDetailRequest;
use App\Http\Requests\Admin\User\EditUserRequest;
use App\Models\AdminUser;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\{Comment_Product, CommentBlog, Customers};
use CKSource\CKFinder\Image;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Validation\Validator;
use MicrosoftAzure\Storage\Common\Internal\Validate;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function List()
    {
        $data['users'] = AdminUser::paginate(15);
        return view('backend.userprofile.user-list', $data);
    }
    public function Detail($slug)
    {
        $data['user'] = AdminUser::where('slug', $slug)->first();
        return view('backend.userprofile.user-profile', $data);
    }
    public function Add()
    {
        return view('backend.userprofile.user-add');
    }
    public function AddPost(AddUserRequest $request)
    {
        if (strlen($request->password) < 8) {
            return back()->with('thong-bao-loi', 'Mật khẩu quá ngắn, nó phải dài hơn 8 kí tự');
        } elseif (strlen($request->password) > 30) {
            return back()->with('thong-bao-loi', 'Mật khẩu quá dài, nó phải ngắn hơn 30 kí tự');
        }
        $user = new AdminUser();
        $user->name = $request->name;
        $user->level = 0;
        $user->slug = Str::slug($request->name);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->datetime = $request->datetime;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        if ($request->image != null) {
            $file = $request->file('image');
            $nameValue = Str::slug($request->name);
            $file_old = public_path('users\\') . $request->image;
            if (file_exists($file_old) != null && $request->image != 'no-img.jpg') {
                $nameImageValue = $nameValue . '-' . Str::random(10) . '.' . $file->extension();
            } else {
                $nameImageValue = $nameValue . '.' . $file->extension();
            }
            $destinationPath = public_path('users\\');
            $file->move($destinationPath, $nameImageValue);
            $user->image = $nameImageValue;
        } else {
            $user->image = 'no-img.jpg';
        }
        $user->save();
        return redirect()->route('admin_user_list')->with('thong-bao-thanh-cong', 'Thêm thành công quản trị ' . $request->name);

        return view('backend.userprofile.user-add');
    }
    public function Edit($slug)
    {
        // dd(AdminUser::role('user')->permission('add')->get());
        // dd(AdminUser::role('user')->get());

        $userItem = AdminUser::where('slug', $slug)->first();
        // dd($userItem->hasAnyRole(['user']));
        // dd($userItem->hasAnyRole(['admin']));
        // dd($userItem->hasAnyRole(['super-admin']));
        // dd($userItem->hasPermissionTo('add'));
        return view('backend.userprofile.user-edit', compact('userItem'));
    }
    public function EditPost(EditUserRequest $request, $id)
    {
        if (strlen($request->phone) < 10 || strlen($request->phone) > 10) {
            return redirect()->back()->with('thong-bao-loi', 'Số điện thoại tối thiểu - tối đa 10 số');
        }
        $user = AdminUser::find($id);
        // Trao quyền
        //Tìm user theo id
        //Xóa tất cả các quyền đã tồn tại của user theo id đó
        $user->revokePermissionTo(
            [
                'view_product', 'view_user', 'view_category', 'view_order',
                'add_product', 'add_user', 'add_category',
                'edit_product', 'edit_user', 'edit_category','edit_order',
                'delete_product', 'delete_user', 'delete_category','delete_order',

            ]
        );
        //Kiểm tra user đó có bất kỳ Role nào không
        if ($user->hasAnyRole(['user', 'admin'])) {
            //Gọi tên Role của user đó
            $roles = $user->getRoleNames();
            foreach ($roles as $key => $value) {
                //Xóa role của user đó
                $user->removeRole($value);
            }
        }
        //Tiến hành thêm quyền khi tích vào ô checkbox
        if ($request->view_product) {
            $user->givePermissionTo('view_product'); //Gán quyền view_product
        }
        if ($request->add_product) {
            $user->givePermissionTo('add_product'); //Gán quyền add_product
        }
        if ($request->edit_product) {
            $user->givePermissionTo('edit_product'); //Gán quyền edit_product
        }
        if ($request->delete_product) {
            $user->givePermissionTo('delete_product'); //Gán quyền delete_product
        }
        // user
        if ($request->view_user) {
            $user->givePermissionTo('view_user'); //Gán quyền view_user
        }
        if ($request->add_user) {
            $user->givePermissionTo('add_user'); //Gán quyền add_user
        }
        if ($request->edit_user) {
            $user->givePermissionTo('edit_user'); //Gán quyền edit_user
        }
        if ($request->delete_user) {
            $user->givePermissionTo('delete_user'); //Gán quyền delete_user
        }
        // category
        if ($request->view_category) {
            $user->givePermissionTo('view_category'); //Gán quyền view_category
        }
        if ($request->add_category) {
            $user->givePermissionTo('add_category'); //Gán quyền add_category
        }
        if ($request->edit_category) {
            $user->givePermissionTo('edit_category'); //Gán quyền edit_category
        }
        if ($request->delete_category) {
            $user->givePermissionTo('delete_category'); //Gán quyền delete_category
        }
        // Order
        if ($request->view_order) {
            $user->givePermissionTo('view_order'); //Gán quyền view_order
        }
        if ($request->edit_order) {
            $user->givePermissionTo('edit_order'); //Gán quyền edit_order
        }
        if ($request->delete_order) {
            $user->givePermissionTo('delete_order'); //Gán quyền delete_order
        }
        // Coment Product
        if ($request->view_comment_product) {
            $user->givePermissionTo('view_comment_product'); //Gán quyền view_comment_product
        }
        if ($request->add_comment_product) {
            $user->givePermissionTo('add_comment_product'); //Gán quyền add_comment_product
        }
        if ($request->delete_comment_product) {
            $user->givePermissionTo('delete_comment_product'); //Gán quyền delete_comment_product
        }
        // Coment Blog
        if ($request->view_comment_blog) {
            $user->givePermissionTo('view_comment_blog'); //Gán quyền view_comment_blog
        }
        if ($request->add_comment_blog) {
            $user->givePermissionTo('add_comment_blog'); //Gán quyền add_comment_blog
        }
        if ($request->delete_comment_blog) {
            $user->givePermissionTo('delete_comment_blog'); //Gán quyền delete_comment_blog
        }
        // Blog
        if ($request->view_blog) {
            $user->givePermissionTo('view_blog');
        }
        if ($request->add_blog) {
            $user->givePermissionTo('add_blog');
        }
        if ($request->edit_blog) {
            $user->givePermissionTo('edit_blog');
        }
        if ($request->delete_blog) {
            $user->givePermissionTo('delete_blog');
        }
        // trademark
        if ($request->view_trademark) {
            $user->givePermissionTo('view_trademark');
        }
        if ($request->add_trademark) {
            $user->givePermissionTo('add_trademark');
        }
        if ($request->edit_trademark) {
            $user->givePermissionTo('edit_trademark');
        }
        if ($request->delete_trademark) {
            $user->givePermissionTo('delete_trademark');
        }
        // logo
        if ($request->view_logo) {
            $user->givePermissionTo('view_logo');
        }
        if ($request->edit_logo) {
            $user->givePermissionTo('edit_logo');
        }
        // slogan
        if ($request->view_slogan) {
            $user->givePermissionTo('view_slogan');
        }
        if ($request->edit_slogan) {
            $user->givePermissionTo('edit_slogan');
        }
        // image_polyci
        if ($request->view_image_polyci) {
            $user->givePermissionTo('view_image_polyci');
        }
        if ($request->add_image_polyci) {
            $user->givePermissionTo('add_image_polyci');
        }
        if ($request->edit_image_polyci) {
            $user->givePermissionTo('edit_image_polyci');
        }
        if ($request->delete_image_polyci) {
            $user->givePermissionTo('delete_image_polyci');
        }
        // slide
        if ($request->view_slide) {
            $user->givePermissionTo('view_slide');
        }
        if ($request->edit_slide) {
            $user->givePermissionTo('edit_slide');
        }
        if ($request->add_slide) {
            $user->givePermissionTo('add_slide');
        }
        if ($request->delete_slide) {
            $user->givePermissionTo('delete_slide');
        }
         // contact
         if ($request->view_contact) {
            $user->givePermissionTo('view_contact');
        }
        if ($request->edit_contact) {
            $user->givePermissionTo('edit_contact');
        }
         // footer
         if ($request->add_footer) {
            $user->givePermissionTo('add_footer');
        }
        if ($request->edit_footer) {
            $user->givePermissionTo('edit_footer');
        }
        if ($request->delete_footer) {
            $user->givePermissionTo('delete_footer');
        }
         // detail_footer
         if ($request->add_detail_footer) {
            $user->givePermissionTo('add_detail_footer');
        }
        if ($request->edit_detail_footer) {
            $user->givePermissionTo('edit_detail_footer');
        }
        if ($request->delete_detail_footer) {
            $user->givePermissionTo('delete_detail_footer');
        }


        if ($user->level != 1) {
            $user->level = 0;
        }
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->datetime = $request->datetime;
        $user->email = $request->email;
        if ($request->image != null) {
            $file_old = public_path('users\\') . $user->image;
            if (file_exists($file_old) != null && $user->image != 'no-img.jpg') {
                unlink($file_old);
            }
            $file = $request->file('image');
            $nameValue = Str::slug($request->name);
            $nameImageValue = $nameValue . '-' . Str::random(10) . '.' . $file->extension();
            $destinationPath = public_path('users\\');
            $file->move($destinationPath, $nameImageValue);
            $user->image = $nameImageValue;
        } else {
            $user->image = $user->image;
        }
        $user->save();
        return redirect()->route('admin_user_list')->with('thong-bao-thanh-cong', 'Cập nhật thành công quản trị');
    }
    public function EditDetailPost(EditUserDetailRequest $request, $id)
    {
        if (strlen($request->phone) < 10 || strlen($request->phone) > 10) {
            return redirect()->back()->with('thong-bao-loi', 'Số điện thoại tối thiểu - tối đa 10 số');
        }
        $user = AdminUser::find($id);
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->datetime = $request->datetime;
        $user->save();
        return redirect()->route('admin_user_list')->with('thong-bao-thanh-cong', 'Cập nhật thành công thông tin quản trị', $request->name);
    }
    public function Delete(Request $request, $id)
    {
        $user = AdminUser::find($id);
        if ($user->hasRole('super-admin') || $user->user_level == 1) {
            return back()->with('thong-bao-loi', 'Bạn không thể xóa tài khoản này');
        } else {
            $file_old = public_path('users\\') . $user->image;
            if (file_exists($file_old) != null && $user->image != 'no-img.jpg') {
                unlink($file_old);
            }
            $user->delete();
            return redirect()->route('admin_user_list')->with('thong-bao-thanh-cong', 'Đã xóa thành công quản trị ' . $request->name);
        }
    }
}
