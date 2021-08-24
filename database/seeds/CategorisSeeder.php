<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert(
            [
                [
                    'id' => '1',
                    'name' => 'Thời trang nam',
                    'slug' => 'thoi-trang-nam',
                    'image' => 'no-img.jpg',
                    'title' => 'Thời trang nam',
                    'parent' => '0',

                    'cate_smail'=>'0',
                ],
                [
                    'id' => '2',
                    'name' => 'Thời trang nữ',
                    'slug' => 'thoi-trang-nu',
                    'image' => 'no-img.jpg',
                    'title' => 'Thời trang nữ',
                    'parent' => '0',

                    'cate_smail'=>'0',
                ],
                [
                    'id' => '3',
                    'name' => 'Quần Nam',
                    'slug' => 'quan-nam',
                    'image' => 'no-img.jpg',
                    'title' => 'Quần nam',
                    'parent' => '1',

                    'cate_smail'=>'1',
                ],
                [
                    'id' => '4',
                    'name' => 'Áo Nam',
                    'slug' => 'ao-nam',
                    'image' => 'no-img.jpg',
                    'title' => 'Áo nam',
                    'parent' => '1',

                    'cate_smail'=>'1',
                ]
            ]
        );
    }
}
