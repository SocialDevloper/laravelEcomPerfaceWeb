<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Profile;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
        	'name' => 'customer',
        	'description' => 'Customer Role'
        ]);

        $role = Role::create([
        	'name' => 'admin',
        	'description' => 'Admin Role'
        ]);

        $user = User::create([
        	'email' => 'admin123@yopmail.com',
        	'password' => bcrypt('admin@123'),
        	'role_id' => $role->id,
        ]);

        $profile = Profile::create([
        	'user_id' => $user->id
        ]);
    }
}
