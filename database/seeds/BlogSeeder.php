<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->delete();
        DB::table('blogs')->insert([
            [
                'id' => '1',
                'title' => 'ONTEGER LECTUS URNA ULTRICIES VEL LECTUS',
                'body' => 'Nulla laoreet ipsum dignissim magna maximus, vitae euis mod turpis iaculis. Sed pharetra lacus sit amet dui conse',
                'image'=>'no-img.jpg',
                'info'=>'Nulla laoreet ipsum dignissim magna maximus',
                'slug'=>'ONTEGER-LECTUS-URNA-ULTRICIES-VEL-LECTUS',
                'user_admin_id' => '1',
            ],
            [
                'id' => '2',
                'title' => 'ONTEGER LECTUS',
                'slug' => 'ONTEGER-LECTUS',
                'info' => 'Nulla laoreet ipsum dignissim magna maximus',
                'body' => 'Nulla laoreet ipsum dignissim magna maximus, vitae euis mod turpis iaculis. Sed pharetra lacus sit amet dui conse',
                'image'=>'no-img.jpg',
                'user_admin_id' => '1',
            ],
        ]);
    }
}
