<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table='orders';
    public function attr()
    {
        return $this->hasMany(Attrs::class,'order_id','id');
    }
}
