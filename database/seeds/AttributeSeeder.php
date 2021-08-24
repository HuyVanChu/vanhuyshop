<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->delete();
        DB::table('attributes')->insert([
            [
                'id' => '1',
                'name' => 'Size',
                'slug' => 'size',
                'cat_id' => '1'
            ],
            [
                'id' => '2',
                'name' => 'Color',
                'slug' => 'color',
                'cat_id' => '2'
            ],
        ]);
    }
}
