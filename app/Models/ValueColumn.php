<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValueColumn extends Model
{
    protected $table='valuecolumn';
    public function column()
    {
        return $this->belongsTo(Properties::class, 'properties_id', 'id');
    }
}
