<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('values')->insert([
            [
                'id' => '1',
                'value' => 'XL',
                'slug' => 'xl',
                'attr_id' => '1',
            ],
            [
                'id' => '2',
                'value' => 'Vàng',
                'slug' => 'vang',
                'attr_id' => '2',
            ],
            [
                'id' => '3',
                'value' => 'S',
                'slug' => 's',
                'attr_id' => '1',
            ],
        ]);
    }
}
