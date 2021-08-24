<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    protected $table='properties';
    public function values()
    {
        return $this->hasMany(valuecolumn::class, 'properties_id', 'id');
    }
}
