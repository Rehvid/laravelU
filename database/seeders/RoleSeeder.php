<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Role::create(['name' => config('auth.roles.admin')]);
         Role::create(['name' => config('auth.roles.manager')]);
         Role::create(['name' => config('auth.roles.worker')]);
    }
}
