<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footers extends Model
{
    protected $table='footers';
    public function footer_detail()
    {
        return $this->hasMany(FooterDetail::class, 'footer_id', 'id');
    }
}
