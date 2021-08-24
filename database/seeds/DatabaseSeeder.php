<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TrademarksSeeder::class,
            CategorisSeeder::class,
            PropertieSeeder::class,
            ProductSeeder::class,
            value_propertie::class,
            ImageProductSeeder::class,
            AttributeSeeder::class,
            ValueSeeder::class,
            ValueProductSeeder::class,
            VariantSeeder::class,
            VariantValueSeeder::class,
            CustomerSeeder::class,
            OderSeeder::class,
            AttrSeeder::class,
            RolePermissionSeeder::class,
            UserAdminSeeder::class,
            ContactSeeder::class,
            BlogSeeder::class,
            CommentSeeder::class,
            BannerSeeder::class,

            SettingSeeder::class,
            FooterSeeder::class,
            FooterDetailSeeder::class,
            ImagePolicySeeder::class,



        ]);
    }
}
