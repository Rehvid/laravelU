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
        Permission::create(['name' => 'statuses.restore']);


        Permission::create(['name' => 'teams.index']);
        Permission::create(['name' => 'teams.store']);
        Permission::create(['name' => 'teams.update']);
        Permission::create(['name' => 'teams.destroy']);
        Permission::create(['name' => 'teams.restore']);

        Permission::create(['name' => 'tasks.index']);
        Permission::create(['name' => 'tasks.store']);
        Permission::create(['name' => 'tasks.update']);
        Permission::create(['name' => 'tasks.destroy']);
        Permission::create(['name' => 'tasks.restore']);
        Permission::create(['name' => 'tasks.done']);
        Permission::create(['name' => 'tasks.change_status']);

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
        $adminRole->givePermissionTo('statuses.restore');

        $adminRole->givePermissionTo('teams.index');
        $adminRole->givePermissionTo('teams.store');
        $adminRole->givePermissionTo('teams.update');
        $adminRole->givePermissionTo('teams.destroy');
        $adminRole->givePermissionTo('teams.restore');

        $adminRole->givePermissionTo('tasks.index');
        $adminRole->givePermissionTo('tasks.store');
        $adminRole->givePermissionTo('tasks.update');
        $adminRole->givePermissionTo('tasks.destroy');
        $adminRole->givePermissionTo('tasks.restore');
        $adminRole->givePermissionTo('tasks.done');
        $adminRole->givePermissionTo('tasks.change_status');

        $managerRole = Role::findByName(config('auth.roles.manager'));

        $managerRole->givePermissionTo('statuses.index');

        $managerRole->givePermissionTo('users.index');
        $managerRole->givePermissionTo('users.change_role');
        $managerRole->givePermissionTo('users.assign_to_team');

        $managerRole->givePermissionTo('teams.index');

        $managerRole->givePermissionTo('tasks.index');
        $managerRole->givePermissionTo('tasks.store');
        $managerRole->givePermissionTo('tasks.update');
        $managerRole->givePermissionTo('tasks.destroy');
        $managerRole->givePermissionTo('tasks.restore');
        $managerRole->givePermissionTo('tasks.done');
        $managerRole->givePermissionTo('tasks.change_status');

        $workerRole = Role::findByName(config('auth.roles.worker'));

        $workerRole->givePermissionTo('statuses.index');

        $workerRole->givePermissionTo('teams.index');

        $workerRole->givePermissionTo('tasks.index');

        $workerRole->givePermissionTo('tasks.done');
        $workerRole->givePermissionTo('tasks.change_status');
    }
}
