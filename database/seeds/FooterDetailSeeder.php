<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('footer_detail')->delete();
        DB::table('footer_detail')->insert([
            [
                'id'=>'1',
                'content' => '32 Khoái Châu - Hưng Yên.',
                'footer_id' => '1',
            ],
            [
                'id'=>'2',
                'content' => '(+84) 037 497 0903',
                'footer_id' => '1',
            ],
            [
                'id'=>'3',
                'content' => '<a href="">Phản hồi</a>',
                'footer_id' => '2',
            ],
            [
                'id'=>'4',
                'content' => '<a href="">Về chúng tôi</a>',
                'footer_id' => '2',
            ],
            [
                'id'=>'5',
                'content' => '<a href="">Chính sách hoàn trả đơn hàng</a>',
                'footer_id' => '2',
            ],
            [
                'id'=>'6',
                'content' => '<a href="#"><i class="fa fa-facebook"></i></a>',
                'footer_id' => '3',
            ],
            [
                'id'=>'7',
                'content' => '<a href="#"><i class="fa fa-instagram"></i></a>',
                'footer_id' => '3',
            ],
            [
                'id'=>'8',
                'content' => '<a href="#"><i class="fa fa-youtube-play"></i></a>',
                'footer_id' => '3',
            ],
        ]);
    }
}
