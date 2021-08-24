<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class value_propertie extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('valuecolumn')->delete();
        DB::table('valuecolumn')->insert([
            [
                'id' => '1',
                'value'=>'ahihi',
                'prd_id' => '1',
                'properties_id' => '1',
            ]
        ]);
    }
}
