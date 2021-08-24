<?php
namespace App\Services;

use App\Models\AdminUser;
use App\Models\Categories;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryService
{

    public function search($id)
    {
        $cat_id = Categories::find($id);
        if (!$cat_id) {
            throw new ModelNotFoundException('Không danh mục có ID' . $id);
        }
        return $cat_id;
    }
}
?>
