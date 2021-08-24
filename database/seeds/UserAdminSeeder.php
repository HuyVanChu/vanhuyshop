<?php

use App\Models\AdminUser;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_user')->delete();
        DB::table('admin_user')->insert([
            [
                'id' => '1',
                'name' => 'chu van huy',
                'email' => 'vanhuyutehy@gmail.com',
                'slug' => 'chu-van-huy',
                'address' => 'văn giang, hưng yên',
                'phone' => '0374970903',
                'image' => 'no-img.jpg',
                'level'=>'0',
                'datetime' => '2021-4-20',
                'password' => Hash::make('123456'),
            ],
            [
                'id' => '2',
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'slug' => 'admin',
                'address' => 'văn giang, hưng yên',
                'phone' => '0374970903',
                'image' => 'no-img.jpg',
                'datetime' => '2021-4-20',
                'level'=>'0',
                'password' => Hash::make('123456'),
            ],
            [
                'id' => '3',
                'name' => 'super-admin',
                'email' => 'superadmin@gmail.com',
                'slug' => 'super-admin',
                'address' => 'văn giang, hưng yên',
                'phone' => '0374970903',
                'image' => 'no-img.jpg',
                'datetime' => '2021-4-20',
                'level'=>'1',
                'password' => Hash::make('123456'),
            ],
        ]);
        AdminUser::find(1)->assignRole('user');
        AdminUser::find(2)->assignRole('admin');
        AdminUser::find(3)->assignRole('super-admin');
    }
}
