<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $csr = Role::create(['name' => 'csr']);
        $rider = Role::create(['name' => 'rider']);
        $manager = Role::create(['name' => 'manager']);

        $admin->givePermissionTo(Permission::all());

        $csr->givePermissionTo(['view inventory', 'create order','edit order','view order','update order', 'view lead', 'update lead', 'view delivery', 'update delivery', 'create customer', 'edit customer', 'update customer', 'view customer']);

        $rider->givePermissionTo(['create delivery', 'edit delivery', 'update delivery', 'view delivery']);

        $manager->givePermissionTo(['create user', 'edit user', 'update user', 'view user', 'create inventory', 'edit inventory', 'update inventory', 'delete inventory', 'view inventory', 'view lead', 'update lead', 'view delivery', 'create customer', 'edit customer', 'update customer', 'view customer']);
    }
}
