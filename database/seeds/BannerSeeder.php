<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->delete();
        DB::table('banners')->insert([
            [
                'id' => '1',
                'image' => '3.jpg',
                'slug' => 'name',
                'name' => 'name',
            ],
            [
                'id' => '2',
                'image' => '4.jpg',
                'slug' => 'name',
                'name' => 'name',

            ],
            [
                'id' => '3',
                'image' => '5.jpg',
                'slug' => 'name',
                'name' => 'name',

            ],
            [
                'id' => '4',
                'image' => '1.jpg',
                'slug' => 'name',
                'name' => 'name',

            ],
        ]);
    }
}
