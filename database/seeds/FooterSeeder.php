<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('footers')->delete();
        DB::table('footers')->insert([
            [
                'id'=>'1',
                'title' => 'Nói chuyện với chúng tôi ngay!',
                'content' => 'LIÊN HỆ CHÚNG TÔI',
                'state' => '1',
            ],
            [
                'id'=>'2',
                'title' => 'Nói chuyện với chúng tôi ngay!',
                'content' => 'DỊCH VỤ CỦA CHÚNG TÔI',
                'state' => '2',
            ],
            [
                'id'=>'3',
                'title' => 'Nói chuyện với chúng tôi ngay!',
                'content' => 'CHÚNG TÔI Ở ĐÂY',
                'state' => '3',
            ],
        ]);
    }
}
