<?php
namespace App\Services;

use App\Models\Trademaks;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TrademarkService
{

    public function search($id)
    {
        $cat_id = Trademaks::find($id);
        if (!$cat_id) {
            throw new ModelNotFoundException('Không có thuownng hiệu có ID' . $id);
        }
        return $cat_id;
    }
    public function search_where($slug)
    {
        $cat_id = Trademaks::where('slug',$slug)->first();
        if (!$cat_id) {
            throw new ModelNotFoundException('Không có thuownng hiệu' . $slug);
        }
        return $cat_id;
    }
}
?>
