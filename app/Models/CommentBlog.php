<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentBlog extends Model
{
    protected $table='comment_blog';
    public function User()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
    public function Blogs()
    {
        return $this->belongsTo(Blogs::class, 'blog_id', 'id');
    }
    public function user_admin()
    {
        return $this->belongsTo(AdminUser::class, 'use_admin_id', 'id');
    }
}
