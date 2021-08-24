<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        DB::table('products')->insert(
            [
                [
                    'id'=>'1',
                    'name' => "Áo Sơ Mi Lacoste Men Regular Fit Mini Piqué Shirt Màu Xanh Navy",
                    'slug' => 'ao-so-mi-lacoste-men-regular-fit-mini-pique-shirt-mau-xanh-navy',
                    'price' => '2200000',
                    'product_code' => 'ASM',
                    'state' => '1',
                    'describer' => 'Áo được làm từ chất vải cotton thoáng mát mang lại cảm giác thoải mái nhất cho người mặc. Form áo chuẩn đẹp từng đường kim mũi chỉ đảm bảo hài lòng ngay cả với khách hàng khó tính nhất.',
                    'image' => 'no-img.jpg',
                    'image2' => 'no-img.jpg',
                    'featured' => '1',
                    'cat_id' => '3',
                    'info' => '3',

                    'title' => 'Áo Sơ Mi Lacoste Men Regular Fit Mini Piqué Shirt Màu Xanh Navy',
                    'trademark_id' => '1',
                ],
                [
                    'id'=>'2',
                    'name' => "Áo Sơ Mi Cộc Tay Nam Giovanni UR679-NV Size S",
                    'slug' => 'ao-so-mi-coc-tay-nam-ur679-nv-size-s',
                    'price' => '2200000',
                    'product_code' => 'ASMCT',
                    'state' => '1',
                    'describer' => 'Áo được làm từ chất vải cotton thoáng mát mang lại cảm giác thoải mái nhất cho người mặc. Form áo chuẩn đẹp từng đường kim mũi chỉ đảm bảo hài lòng ngay cả với khách hàng khó tính nhất.',
                    'info' => 'Áo được làm từ chất vải cotton thoáng mát mang lại cảm giác thoải mái nhất cho người mặc. Form áo chuẩn đẹp từng đường kim mũi chỉ đảm bảo hài lòng ngay cả với khách hàng khó tính nhất.',
                    'image' => 'no-img.jpg',
                    'image2' => 'no-img.jpg',
                    'featured' => '1',
                    'cat_id' => '3',

                    'title' => 'Áo Sơ Mi Cộc Tay Nam Giovanni UR679-NV Size S',
                    'trademark_id' => '1',
                ],
                [
                    'id'=>'3',
                    'name' => "Mũ MLB New York Yankees Heroes Adjustable Cap Màu Đen",
                    'slug' => 'mu-mlb-new-york-yankees-heroes-adjustable-cap-mau-den',
                    'price' => '2200000',
                    'product_code' => 'MLC',
                    'state' => '1',
                    'describer' => 'Áo được làm từ chất vải cotton thoáng mát mang lại cảm giác thoải mái nhất cho người mặc. Form áo chuẩn đẹp từng đường kim mũi chỉ đảm bảo hài lòng ngay cả với khách hàng khó tính nhất.',
                    'info' => 'Áo được làm từ chất vải cotton thoáng mát mang lại cảm giác thoải mái nhất cho người mặc. Form áo chuẩn đẹp từng đường kim mũi chỉ đảm bảo hài lòng ngay cả với khách hàng khó tính nhất.',
                    'image' => 'no-img.jpg',
                    'image2' => 'no-img.jpg',
                    'featured' => '1',
                    'cat_id' => '3',

                    'title' => 'Mũ MLB New York Yankees Heroes Adjustable Cap Màu Đen',
                    'trademark_id' => '1',
                ],
                [
                    'id'=>'4',
                    'name' => "Túi Xách Venuco Madrid F87 - Hồng Lưới - P26F87",
                    'slug' => 'tui-xach-venuco-madrid-f87-hong-luoi-p26f87',
                    'price' => '2200000',
                    'product_code' => 'MLC1',
                    'state' => '1',
                    'describer' => 'Áo được làm từ chất vải cotton thoáng mát mang lại cảm giác thoải mái nhất cho người mặc. Form áo chuẩn đẹp từng đường kim mũi chỉ đảm bảo hài lòng ngay cả với khách hàng khó tính nhất.',
                    'info' => 'Áo được làm từ chất vải cotton thoáng mát mang lại cảm giác thoải mái nhất cho người mặc. Form áo chuẩn đẹp từng đường kim mũi chỉ đảm bảo hài lòng ngay cả với khách hàng khó tính nhất.',
                    'image' => 'no-img.jpg',
                    'image2' => 'no-img.jpg',
                    'featured' => '1',
                    'cat_id' => '3',

                    'title' => 'Túi Xách Venuco Madrid F87 - Hồng Lưới - P26F87',
                    'trademark_id' => '1',
                ]
            ]
        );
    }
}
