<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $table='blogs';
    public function Admin()
    {
        return $this->belongsTo(AdminUser::class, 'user_admin_id', 'id');
    }
    public function commentBlog()
    {
        return $this->hasMany(CommentBlog::class, 'blog_id', 'id');
    }
}
