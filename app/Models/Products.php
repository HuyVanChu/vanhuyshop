<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table='products';
    protected $fillable =
    [
        'name',
        'slug',
        'title',
        'price',
        'product_code',
        'state',
        'describer',
        'image',
        'info',
        'featured',
        'amount',
        'cat_id',
        'trademark_id'
    ];
    public function Trademaks()
    {
        return $this->belongsTo(Trademaks::class, 'trademark_id', 'id');
    }
    public function Categories()
    {
        return $this->belongsTo(Categories::class, 'cat_id', 'id');
    }
    public function value_column()
    {
        return $this->hasMany(ValueColumn::class, 'prd_id', 'id');
    }
    public function Properties()
    {
        return $this->belongsToMany(Properties::class, 'propertie_product', 'product_id', 'propertie_id');
    }
    public function values()
    {
        return $this->belongsToMany(Values::class, 'value_product', 'product_id', 'value_id');
    }
    public function variant()
    {
        return $this->hasMany(Variants::class, 'product_id', 'id');
    }
    public function productdetail()
    {
        return $this->hasMany(Image_Product::class, 'prd_id', 'id');
    }
    public function comment()
    {
        return $this->hasMany(Comment_Product::class, 'prd_id', 'id');
    }
}
