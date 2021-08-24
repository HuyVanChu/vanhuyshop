<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TrademarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trademarks')->delete();
        DB::table('trademarks')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'MLB',
                    'slug' => 'mlb',
                    'image' => 'no-img.jpg',
                    'title' => 'MLB',
                  
                ],
                [
                    'id' => 2,
                    'name' => 'Gucci',
                    'slug' => 'gucci',
                    'image' => 'no-img.jpg',
                    'title' => 'Gucci',
                  
                ],
                [
                    'id' => 3,
                    'name' => 'Lacoste',
                    'slug' => 'lacoste',
                    'image' => 'no-img.jpg',
                    'title' => 'Lacoste',
                  
                ],
                [
                    'id' => 4,
                    'name' => 'Adidas',
                    'slug' => 'adidas',
                    'image' => 'no-img.jpg',
                    'title' => 'Adidas',
                  
                ],
                [
                    'id' => 5,
                    'name' => 'Tommy',
                    'slug' => 'tommy',
                    'image' => 'no-img.jpg',
                    'title' => 'Tommy',
                  
                ],
                [
                    'id' => 6,
                    'name' => 'Thom Browne',
                    'slug' => 'thom-browne',
                    'image' => 'no-img.jpg',
                    'title' => 'Thom Browne',
                  
                ]
            ],



        );
    }
}
