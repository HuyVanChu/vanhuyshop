<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment_Product extends Model
{
    protected $table='comment_product';
    public function users()
    {
        return $this->belongsTo(Users::class, 'use_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Products::class, 'prd_id', 'id');
    }
    public function user_admin()
    {
        return $this->belongsTo(AdminUser::class, 'use_admin_id', 'id');
    }
}
