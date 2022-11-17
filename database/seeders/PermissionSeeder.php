<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.change_role']);
        Permission::create(['name' => 'users.assign_to_team']);

        Permission::create(['name' => 'log-viewer']);

        $adminRole = Role::findByName(config('auth.roles.admin'));
        $adminRole->givePermissionTo('users.index');
        $adminRole->givePermissionTo('users.store');
        $adminRole->givePermissionTo('users.update');
        $adminRole->givePermissionTo('users.destroy');
        $adminRole->givePermissionTo('users.change_role');
        $adminRole->givePermissionTo('users.assign_to_team');

        $adminRole->givePermissionTo('log-viewer');
    }
}
