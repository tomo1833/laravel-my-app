<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'anime edit']);
        Permission::create(['name' => 'anime show']);
        Permission::create(['name' => 'anime delete']);

        $role = Role::create(['name' => 'admin']);
        $role_member = Role::create(['name' => 'member']);
        $role_general = Role::create(['name' => 'general']);

        $role->givePermissionTo(['anime show', 'anime edit', 'anime delete']);
        $role_member->givePermissionTo(['anime show', 'anime edit']);
        $role_general->givePermissionTo(['anime show']);

    }
}
