<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Superadmin have all permissions
        $superadmin = Role::create(['name' => 'superadmin']);
        $permissions = Permission::all();
        $superadmin->syncPermissions($permissions);

        $admin = Role::create(['name' => 'admin']);
        $permissions = Permission::whereIn('name',
            [
                'user-list',
                'user-create',
                'user-edit',
                'user-delete',

                'role-list',
                'role-create',
                'role-edit',
                'role-delete',

                'tour-category-list',
                'tour-category-create',
                'tour-category-edit',
                'tour-category-delete',

                'tour-list',
                'tour-create',
                'tour-edit',
                'tour-delete',

                'news-category-list',
                'news-category-create',
                'news-category-edit',
                'news-category-delete',

                'news-list',
                'news-create',
                'news-edit',
                'news-delete',

                'lodge-list',
                'lodge-create',
                'lodge-edit',
                'lodge-delete',

                'employee-list',
                'employee-create',
                'employee-edit',
                'employee-delete',
            ]
        )->get();
        $admin->syncPermissions($permissions);

        $treasurer = Role::create(['name' => 'treasurer']);
        $permissions = Permission::whereIn('name',
            [
            'reservation-list',
            'reservation-create',
            'reservation-edit',
            'reservation-delete',

            'tour-package-list',
            'tour-package-create',
            'tour-package-edit',
            'tour-package-delete',
            ]
        )->get();
        $treasurer->syncPermissions($permissions);

        $owner = Role::create(['name' => 'owner']);
        $permissions = Permission::whereIn('name',
            [
                'report',
            ]
        )->get();
        $owner->syncPermissions($permissions);

        $customer = Role::create(['name' => 'customer']);
        $permissions = Permission::whereIn('name',
            [
                'reservation-list',
                'reservation-create',
                'reservation-edit',
            ]
        )->get();
        $customer->syncPermissions($permissions);
    }
}
