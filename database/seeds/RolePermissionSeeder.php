<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // Tạo quyền
        // view
        Permission::create(['guard_name' => 'web', 'name' => 'view_product']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_user']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_category']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_order']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_comment_product']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_comment_blog']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_blog']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_trademark']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_logo']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_slogan']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_image_polyci']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_slide']);
        Permission::create(['guard_name' => 'web', 'name' => 'view_contact']);
        // add
        Permission::create(['guard_name' => 'web', 'name' => 'add_product']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_user']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_category']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_comment_product']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_comment_blog']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_blog']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_trademark']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_image_polyci']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_footer']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_detail_footer']);
        Permission::create(['guard_name' => 'web', 'name' => 'add_slide']);
        // edit
        Permission::create(['guard_name' => 'web', 'name' => 'edit_product']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_user']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_category']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_order']);

        Permission::create(['guard_name' => 'web', 'name' => 'edit_blog']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_trademark']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_logo']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_slogan']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_image_polyci']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_footer']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_detail_footer']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_slide']);
        Permission::create(['guard_name' => 'web', 'name' => 'edit_contact']);
        // remove
        Permission::create(['guard_name' => 'web', 'name' => 'delete_product']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_user']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_category']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_order']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_comment_product']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_comment_blog']);

        Permission::create(['guard_name' => 'web', 'name' => 'delete_blog']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_trademark']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_image_polyci']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_footer']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_detail_footer']);
        Permission::create(['guard_name' => 'web', 'name' => 'delete_slide']);

        // Tạo Role(Chức vụ) và gán quyền
        $role1 = Role::create(['guard_name' => 'web', 'name' => 'user']);
        // view
        $role1->givePermissionTo('view_product');
        $role1->givePermissionTo('view_user');
        $role1->givePermissionTo('view_category');
        $role1->givePermissionTo('view_order');
        $role1->givePermissionTo('view_comment_product');
        $role1->givePermissionTo('view_comment_blog');

        $role2 = Role::create(['guard_name' => 'web', 'name' => 'admin']);
        // view
        $role2->givePermissionTo('view_product');
        $role2->givePermissionTo('view_user');
        $role2->givePermissionTo('view_category');
        $role2->givePermissionTo('view_order');
        $role2->givePermissionTo('view_comment_product');
        $role2->givePermissionTo('view_comment_blog');
        // add
        $role2->givePermissionTo('add_product');
        $role2->givePermissionTo('add_user');
        $role2->givePermissionTo('add_category');
        $role2->givePermissionTo('add_comment_product');
        $role2->givePermissionTo('add_comment_blog');
        // edit
        $role2->givePermissionTo('edit_product');
        $role2->givePermissionTo('edit_user');
        $role2->givePermissionTo('edit_category');
        $role2->givePermissionTo('edit_order');

        $role3 = Role::create(['guard_name' => 'web', 'name' => 'super-admin']);
        // view
        $role3->givePermissionTo('view_product');
        $role3->givePermissionTo('view_user');
        $role3->givePermissionTo('view_category');
        $role3->givePermissionTo('view_order');
        $role3->givePermissionTo('view_comment_product');
        $role3->givePermissionTo('view_comment_blog');
        $role3->givePermissionTo('view_blog');
        $role3->givePermissionTo('view_trademark');
        $role3->givePermissionTo('view_logo');
        $role3->givePermissionTo('view_slogan');
        $role3->givePermissionTo('view_image_polyci');
        $role3->givePermissionTo('view_slide');
        $role3->givePermissionTo('view_contact');
        // add
        $role3->givePermissionTo('add_product');
        $role3->givePermissionTo('add_user');
        $role3->givePermissionTo('add_category');
        $role3->givePermissionTo('add_comment_product');
        $role3->givePermissionTo('add_comment_blog');
        $role3->givePermissionTo('add_blog');
        $role3->givePermissionTo('add_trademark');
        $role3->givePermissionTo('add_image_polyci');
        $role3->givePermissionTo('add_footer');
        $role3->givePermissionTo('add_detail_footer');
        $role3->givePermissionTo('add_slide');
        // edit
        $role3->givePermissionTo('edit_product');
        $role3->givePermissionTo('edit_user');
        $role3->givePermissionTo('edit_category');
        $role3->givePermissionTo('edit_order');
        $role3->givePermissionTo('edit_blog');
        $role3->givePermissionTo('edit_trademark');
        $role3->givePermissionTo('edit_logo');
        $role3->givePermissionTo('edit_slogan');
        $role3->givePermissionTo('edit_image_polyci');
        $role3->givePermissionTo('edit_footer');
        $role3->givePermissionTo('edit_detail_footer');
        $role3->givePermissionTo('edit_slide');
        $role3->givePermissionTo('edit_contact');
        // remove
        $role3->givePermissionTo('delete_product');
        $role3->givePermissionTo('delete_user');
        $role3->givePermissionTo('delete_category');
        $role3->givePermissionTo('delete_order');
        $role3->givePermissionTo('delete_comment_product');
        $role3->givePermissionTo('delete_comment_blog');
        $role3->givePermissionTo('delete_blog');
        $role3->givePermissionTo('delete_trademark');
        $role3->givePermissionTo('delete_image_polyci');
        $role3->givePermissionTo('delete_footer');
        $role3->givePermissionTo('delete_detail_footer');
        $role3->givePermissionTo('delete_slide');
    }
}
