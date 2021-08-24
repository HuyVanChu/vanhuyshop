<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->delete();
        DB::table('properties')->insert([
            [
                'id'=>'1',
                'column' => 'Dáng',
                'cat_id' => '3',
                'slug' => 'dang',
            ],
            [
                'id'=>'2',
                'column' => 'Kiểu',
                'cat_id' => '3',
                'slug' => 'kieu',

            ],
        ]);
    }
}
