<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagePolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('image_policy')->delete();
        DB::table('image_policy')->insert([
            [
                'id'=>'1',
                'icon' => '<i class="flaticon flaticon-origami28"></i>',
                'content' => 'MIỄN PHÍ VẬN CHUYỂN VỚI ĐƠN HÀNG 2000.000 VNĐ',
            ],
            [
                'id'=>'2',
                'icon' => '<i class="flaticon flaticon-curvearrows9"></i>',
                'content' => 'CHÍNH SÁCH HOÀN TIỀN',
            ],
            [
                'id'=>'3',
                'icon' => '<i class="flaticon flaticon-headphones54"></i>',
                'content' => 'HỖ TRỢ 24/7',
            ],
        ]);
    }
}
