<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table='customers';
    public function OrderDetail()
    {
        return $this->hasMany(OrderDetail::class,'customer_id', 'id');
    }
}
