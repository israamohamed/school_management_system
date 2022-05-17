<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class SuperAdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name' , 'super admin')->first();
        if(!$role)
        {
            $role = Role::create([
                'name' => 'super admin',
                'display_name' => ['en' => 'super admin' , 'ar' => 'super admin'],
                'guard_name' => 'web',
            ]);
        }

        $user = User::where('name' , 'Admin')->first();
        if(!$user)
        {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => '123456'
            ]);
        }

        $user->assignRole($role->name);
        
    }
}
