<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserRolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Create permissions for products
        $createProduct = Permission::create(['name' => 'create_product']);
        $readProduct = Permission::create(['name' => 'read_product']);
        $updateProduct = Permission::create(['name' => 'update_product']);
        $deleteProduct = Permission::create(['name' => 'delete_product']);

        // Create permissions for categories
        $createCategory = Permission::create(['name' => 'create_category']);
        $readCategory = Permission::create(['name' => 'read_category']);
        $updateCategory = Permission::create(['name' => 'update_category']);
        $deleteCategory = Permission::create(['name' => 'delete_category']);

        // Attach permissions to roles
        $adminRole->permissions()->attach([
            $createProduct->id,
            $readProduct->id,
            $updateProduct->id,
            $deleteProduct->id,
            $createCategory->id,
            $readCategory->id,
            $updateCategory->id,
            $deleteCategory->id
        ]);

        $userRole->permissions()->attach([
            $readProduct->id,
            $readCategory->id
        ]);

        // Create an admin user and assign the admin role
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => $adminRole->id
        ]);
        $admin->roles()->attach($adminRole);

        // Create a regular user and assign the user role
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => $userRole->id
        ]);
        $user->roles()->attach($userRole);
    }
}
