<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('image_product')->delete();
        DB::table('image_product')->insert([
            'image' => 'no-img.jpg',
            'prd_id' => '1',
        ]);
    }
}
