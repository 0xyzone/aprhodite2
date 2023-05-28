<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'view user']);

        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'edit role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'view role']);

        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'edit permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);
        Permission::create(['name' => 'view permission']);

        Permission::create(['name' => 'create inventory']);
        Permission::create(['name' => 'edit inventory']);
        Permission::create(['name' => 'update inventory']);
        Permission::create(['name' => 'delete inventory']);
        Permission::create(['name' => 'view inventory']);

        Permission::create(['name' => 'create order']);
        Permission::create(['name' => 'edit order']);
        Permission::create(['name' => 'update order']);
        Permission::create(['name' => 'delete order']);
        Permission::create(['name' => 'view order']);

        Permission::create(['name' => 'create lead']);
        Permission::create(['name' => 'edit lead']);
        Permission::create(['name' => 'update lead']);
        Permission::create(['name' => 'delete lead']);
        Permission::create(['name' => 'view lead']);

        Permission::create(['name' => 'create delivery']);
        Permission::create(['name' => 'edit delivery']);
        Permission::create(['name' => 'update delivery']);
        Permission::create(['name' => 'delete delivery']);
        Permission::create(['name' => 'view delivery']);
    }
}
