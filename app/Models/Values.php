<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Values extends Model
{
    protected $table='values';
    public function attribute()
    {
        return $this->belongsTo(Attributes::class, 'attr_id', 'id');
    }
    public function products()
    {
        return $this->belongsToMany(Products::class, 'value_product', 'value_id', 'product_id');
    }
}
