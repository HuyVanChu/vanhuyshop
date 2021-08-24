<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment_product')->delete();
        DB::table('comment_product')->insert([
            'id'=>'1',
            'comment' => 'Chu Văn Huy',
            'image' => 'no-img.jpg',
            'prd_id' => '1',
            'use_admin_id' => '1',
            'use_id' => '1',
            'state' => '0',
            'parent' => '0',
            'name_user_comment' => 'Chu Văn Huy',

        ]);
    }
}
