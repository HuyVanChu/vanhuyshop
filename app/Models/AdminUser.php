<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class AdminUser extends Authenticatable
{

    use Notifiable;
    use HasRoles;
    protected $table='admin_user';
    protected $guard_name = 'web';
    protected $fillable = [
        'email', 'password', 'role_id'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

}
