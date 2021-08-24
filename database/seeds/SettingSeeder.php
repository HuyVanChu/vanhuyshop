<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->delete();
        DB::table('setting')->insert([
            [
                'id'=>'1',
                'logo' => 'no-img.jpg',
                'slogan' => 'khau hieu 1',
                'state'=>0
            ],
            [
                'id'=>'2',
                'logo' => 'no-img.jpg',
                'slogan' => 'khau hieu 2',
                'state'=>1
            ],

        ]);
    }
}
