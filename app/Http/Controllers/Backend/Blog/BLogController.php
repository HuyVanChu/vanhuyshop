<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\AddBlogRequest;
use App\Http\Requests\Admin\Blog\AddCommentBlogRequest;
use App\Http\Requests\Admin\Blog\EditBlogRequest;
use App\Models\Blogs;
use App\Services\BlogService;
use Carbon\Carbon;
use DateTime;
use App\Models\{Comment_Product, CommentBlog, Customers};

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BLogController extends Controller
{
    private $blog;

    public function __construct(BlogService $blog)
    {
        $this->blog = $blog;
    }
    public function List()
    {
        // $blog = Blogs::find(7);
        // $interval = Carbon::now()->diff($blog->created_at);
        // $x= $interval->format("%h giờ %i giây trước");
        // $check_h=$interval->format("%h");
        // $check_d=$interval->format("%d");
        // if ($check_h>0) {
        //     dd(1);
        // }elseif ($check_d>0) {
        //     dd(2);
        // }
        //dd($interval);
        $data['blogs'] = Blogs::paginate(6);
        return view('backend.blog.listblog', $data);
    }
    public function AddBlog()
    {
        return view('backend.blog.blog_new');
    }
    public function AddBlogPost(AddBlogRequest $request)
    {
        $blog = new Blogs();
        $blog->title = $request->title;
        $blog->info = $request->info;
        $blog->slug = Str::slug($request->title);
        $blog->body = $request->body;
        $blog->user_admin_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nameValue = Str::slug($request->title);
            $nameImageValue = $nameValue . '.' . $image->extension();
            if ($nameImageValue != 'no-img.jpg') {
                $file_old = public_path('blogs\\') . $nameImageValue;
                if (file_exists($file_old) != null) {
                    $nameImageValue = $nameValue . Str::random(3) . '.' . $image->extension();
                    $destinationPath = public_path('blogs\\');
                    $image->move($destinationPath, $nameImageValue);
                    $blog->image = $nameImageValue;
                } else {
                    $destinationPath = public_path('blogs\\');
                    $image->move($destinationPath, $nameImageValue);
                    $blog->image = $nameImageValue;
                }
            } else {
                $blog->image = $nameImageValue;
            }
        } else {
            $blog->image = 'no-img.jpg';
        }
        $blog->save();
        return redirect()->route('admin.bloglist')->with('thong-bao', 'Đã thêm thành công bài viết ' . $request->title);
    }
    public function EditBlog(Request $request)
    {
        $data['blog'] = Blogs::where('slug', $request->slug)->first();
        return view('backend.blog.blog_edit', $data);
    }
    public function EditPostBlog(EditBlogRequest $request, $id, $slug)
    {
        $blog = Blogs::where('slug', $slug)->first();
        if ($request->image != null) {
            $file_old = public_path('blogs\\') . $blog->image;
            if (file_exists($file_old) != null && $blog->image != 'no-img.jpg') {
                unlink($file_old);
            }
            $file = $request->file('image');
            $nameValue = Str::slug($request->title);
            $nameImageValue = $nameValue . '-' . $file->extension();
            $destinationPath = public_path('blogs\\');
            $file->move($destinationPath, $nameImageValue);
            $blog->image = $nameImageValue;
        } else {
            $blog->image = $blog->image;
        }
        $blog->title = $request->title;
        $blog->info = $request->info;
        $blog->body = $request->body;
        $blog->slug = Str::slug($request->title);
        $blog->save();
        return redirect()->route('admin.bloglist')->with('thong-bao', 'Đã sửa thành công bài viết ' . $request->title);
    }
    public function RemoveBlog($id)
    {
        try {
            $blog = $this->blog->search_id($id);
            $file_old = public_path('blogs\\') . $blog->image;
            if (file_exists($file_old) != null && $blog->image != 'no-img.jpg') {
                unlink($file_old);
            }
            $blog->delete();
            return back()->with('thong-bao', 'Đã xóa thành công bài viết');
        } catch (ModelNotFoundException $exception) {
            return back();
        }
    }
    public function Search(Request $request)
    {
        $data['blogs'] = Blogs::where('title', 'like', '%' . $request->q . '%')
            ->paginate(15);
        $data['count'] = $data['blogs']->count();
        $data['namesearch'] = $request->q;
        return view('backend.blog.listblog', $data);
    }
    function CommentBlogNo()
    {
        $data['comment_blogs'] = CommentBlog::where('state', '0')->paginate(20);
        return view('backend.blog.list_cmt_blog', $data);
    }
    public function CommentBlogNoPost(AddCommentBlogRequest $request)
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
            $cmt_find = CommentBlog::find($request->commen_id);
            $cmt_find->state = 1;
            $cmt_find->save();
            $cmt = new CommentBlog();
            $cmt->comnent = $request->comment;
            $cmt->use_admin_id = Auth::user()->id;
            $cmt->state = 1;
            $cmt->parent = $request->id;
            $cmt->blog_id = $request->commen_blog_id;
            $cmt->name_user_comment = $request->name_user;
            $cmt->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã trả lời bình luận');
        }
    }
    public function CommentBlogYes()
    {
        $data['comment_blogs'] = CommentBlog::where('state', '1')->paginate(20);
        $data['comment_blogs_admin'] = CommentBlog::where('user_id', null)->get();
        return view('backend.blog.blog_cmtblog_sucsess', $data);
    }
    public function CommentBlogYesPost(Request $request)
    {
        if ($request->add_cmt_da_rep) {
            $cmt = CommentBlog::find($request->comment_id);
            $cmt->comnent = $request->comment;
            $cmt->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã cập nhật bình luận thành công');
        } elseif ($request->add_cmt_da_rep_1) {
            $cmt = new CommentBlog();
            $cmt->comnent = $request->comment;
            $cmt->use_admin_id = Auth::user()->id;
            $cmt->state = 1;
            $cmt->parent = $request->id_cmt_con;
            $cmt->blog_id = $request->blog_id;
            $cmt->name_user_comment = $request->name_user_comment;
            $cmt->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã trả lời bình luận');
        } elseif ($request->add_cmt_da_rep_2) {
            $cmt_find = CommentBlog::find($request->comment_id);
            $cmt_find->comnent = $request->comment;
            $cmt_find->save();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã trả lời bình luận');
        }
    }
    public function Remove(Request $request, $id)
    {
        $cmt_find = CommentBlog::find($id);
        if ($request->admin) {
            $cmt_find->delete();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã xóa bình luận');
        } elseif ($request->remove_clien) {
            foreach (CommentBlog::all() as $value) {
                if ($value->parent == $id) {
                    $value->delete();
                }
            }
            $cal = CommentBlog::find($id);
            $cal->delete();
            return redirect()->back()->with('thong-bao-thanh-cong', 'Đã xóa bình luận');
        }
    }
}
