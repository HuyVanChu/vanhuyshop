<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variants extends Model
{
    protected $table='variants';
    public $timestamps=false;
    public function values()
    {
        return $this->belongsToMany(Values::class, 'variant_value', 'variant_id', 'values_id');
    }
}
