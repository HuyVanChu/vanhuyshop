<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table='categories';
    protected $fillable =
    [
        'name',
        'slug',
        'image',
        'title',
        'parent',
        'icon',
    ];
    public function Trademark()
    {
        return $this->belongsTo(Trademaks::class, 'trademark_id', 'id');
    }
    public function properties()
    {
        return $this->hasMany(Properties::class, 'cat_id', 'id');
    }
    public function CategoriesAttribute()
    {
        return $this->hasMany(Attributes::class, 'cat_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Products::class, 'cat_id', 'id');
    }
    public function Attribute()
    {
        return $this->hasMany(Attributes::class, 'cat_id', 'id');
    }

}
