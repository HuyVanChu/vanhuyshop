<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    protected $table='attributes';
    protected $primaryKey='id';
    public function values()
    {
        return $this->hasMany(Values::class, 'attr_id', 'id');
    }

}
