<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variant_value')->insert([
            [
                'variant_id' => '1',
                'values_id' => '1',
            ],
            ['variant_id'=>1,'values_id'=>'3'],
        ]);
    }
}
