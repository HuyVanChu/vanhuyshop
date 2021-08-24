<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->delete();
        DB::table('customers')->insert([
            'id'=>'1',
            'name' => 'Chu Văn Huy',
            'address' => 'Hưng Yên',
            'email' => 'vanhuyutehy@gmail.com',
            'phone' => '0374970903',
            'total' => '2000000',
            'state' => '0',
            'note' => 'Giao đúng hnaj nhé',
            'slug' => 'tui-xach-venuco-mardid-f87',
        ]);
    }
}
