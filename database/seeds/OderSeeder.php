<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->delete();
        DB::table('orders')->insert([
            'id'=>'1',
            'name' => 'Túi Xách Venuco Madrid F87',
            'price' => '2000000',
            'quantity' => '3',
            'image' => 'no-img.jpg',
            'customer_id' => '1'
        ]);
        
    }
}
