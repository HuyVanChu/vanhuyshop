<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment_blog')->delete();
        DB::table('comment_blog')->insert([
            'id'=>'1',
            'comnent' => 'Praesent accumsan, nunc eget semper cursus, tellus nisl sagittis massa, vel egestas erat odio sed sapien. In malesuada ipsum ut elit pretium. In a luctus tellus. Fusce id euismod justo.',
            'user_id' => '1',
            'blog_id' => '1',
            'state' => '0',
            'parent' => '0',
        ]);
    }
}
