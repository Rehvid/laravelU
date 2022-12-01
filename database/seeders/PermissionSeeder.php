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

        Permission::create(['name' => 'statuses.index']);
        Permission::create(['name' => 'statuses.store']);
        Permission::create(['name' => 'statuses.update']);
        Permission::create(['name' => 'statuses.destroy']);

        $adminRole = Role::findByName(config('auth.roles.admin'));
        $adminRole->givePermissionTo('users.index');
        $adminRole->givePermissionTo('users.store');
        $adminRole->givePermissionTo('users.update');
        $adminRole->givePermissionTo('users.destroy');
        $adminRole->givePermissionTo('users.change_role');
        $adminRole->givePermissionTo('users.assign_to_team');
        $adminRole->givePermissionTo('log-viewer');
        $adminRole->givePermissionTo('statuses.index');
        $adminRole->givePermissionTo('statuses.store');
        $adminRole->givePermissionTo('statuses.update');
        $adminRole->givePermissionTo('statuses.destroy');

        $managerRole = Role::findByName(config('auth.roles.manager'));
        $managerRole->givePermissionTo('statuses.index');

        $workerRole = Role::findByName(config('auth.roles.worker'));
    }
}
