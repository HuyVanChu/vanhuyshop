<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attr')->delete();
        DB::table('attr')->insert([
            'id'=>'1',
            'name' => 'Size',
            'value' => 's',
            'order_id' => '1',
        ]);
    }
}
