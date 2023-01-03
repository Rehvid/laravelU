<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'team_id' => '1',
            'email' => 'admin.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);
        $adminRole =  Role::findByName(config('auth.roles.admin'));
        if (isset($adminRole)) {
            $admin->assignRole($adminRole);
        }

        $manager = User::create([
            'name' => 'Manager Test',
            'team_id' => '2',
            'email' => 'manager.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);

        $managerRole =  Role::findByName(config('auth.roles.manager'));
        if (isset($managerRole)) {
            $manager->assignRole($managerRole);
        }

        $worker = User::create([
            'name' => 'Worker Test',
            'team_id' => '0',
            'email' => 'worker.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
        ]);

        $workerRole =  Role::findByName(config('auth.roles.worker'));
        if (isset($workerRole)) {
            $worker->assignRole($workerRole);
        }

    }
}
