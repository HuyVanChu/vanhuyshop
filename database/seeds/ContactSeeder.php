<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->delete();
        DB::table('contacts')->insert([
            'id'=>'1',
            'title1' => '<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d7452.4240477344765!2d105.9270653!3d20.9439989!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1620383890822!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'title3' => 'Muốn nói chuyện với đại diện bán hàng? Hãy nhắn cho chúng tôi và chúng tôi sẵn lòng trả lời bất kỳ câu hỏi nào!',

        ]);
    }
}
