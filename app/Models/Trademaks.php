<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trademaks extends Model
{
    protected $table = 'trademarks';
    //protected $fillable = ['_token'];
    public function products()
    {
        return $this->hasMany(Products::class, 'trademark_id', 'id');
    }
}
