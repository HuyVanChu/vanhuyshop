<?php
namespace App\Services;
use App\Models\{Blogs,Categories};
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BlogService
{
    public function search_where($slug)
    {
        $blog = Blogs::where('slug', $slug)->first();
        if (!$blog) {
            throw new ModelNotFoundException('Có một lỗi ngoại lệ khi truyền slug');
        }
        return $blog;
    }
    public function search_id($id)
    {
        $blog = Blogs::find($id);
        if (!$blog) {
            throw new ModelNotFoundException('Có một lỗi ngoại lệ khi truyền id');
        }
        return $blog;
    }
    public function category_where()
    {
        $category=Categories::where('cate_smail', '<>', '0')->get();
        if (!$category) {
            throw new ModelNotFoundException('Có một lỗi ngoại lệ category_where');
        }
        return $category;
    }
}
?>
