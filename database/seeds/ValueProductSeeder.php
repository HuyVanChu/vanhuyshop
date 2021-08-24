<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValueProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('value_product')->delete();
        DB::table('value_product')->insert([
            [
                'value_id' => '1',
                'product_id' => '1',
            ],
            [
                'value_id' => '1',
                'product_id' => '1',
            ],
        ]);
    }
}
