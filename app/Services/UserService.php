<?php
namespace App\Services;

use App\Models\AdminUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{

    public function search($user_id)
    {
        $user = AdminUser::find($user_id);
        if (!$user) {
            throw new ModelNotFoundException('Không tìm thấy quản trị có ID' . $user_id);
        }
        return $user;
    }
}
?>
