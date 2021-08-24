<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'Chu Văn Huy',
                'email' => 'vanhuyutehy@gmail.com',
                'slug' => 'chu-van-huy',
                'address' => 'văn giang, hưng yên',
                'phone' => '0374970903',
                'image' => 'no-img.jpg',
                'state_review' => '1',
                'review' => 'Sản phẩm raasrt ok',
                'datetime' => '2021-4-20',
                'password' => Hash::make('1'),
            ],
            [
                'id' => '2',
                'name' => 'Chu Văn Tuan',
                'email' => 'vantuan@gmail.com',
                'slug' => 'chu-van-tuan',
                'address' => 'văn giang, hưng yên',
                'phone' => '0374970905',
                'image' => 'no-img.jpg',
                'state_review' => '1',
                'review' => 'Sản phẩm raasrt ok',
                'datetime' => '2021-4-20',
                'password' => Hash::make('1'),
            ],
            [
                'id' => '3',
                'name' => 'Chu Văn Huynh',
                'email' => 'vanhuyunh@gmail.com',
                'slug' => 'chu-van-huynh',
                'address' => 'văn giang, hưng yên',
                'phone' => '0374970904',
                'image' => 'no-img.jpg',
                'state_review' => '1',
                'review' => 'Sản phẩm raasrt ok',
                'datetime' => '2021-4-20',
                'password' => Hash::make('1'),
            ],

        ]);
    }
}
