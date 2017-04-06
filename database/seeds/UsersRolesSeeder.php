<?php

use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = ['user', 'reseller', 'manager', 'supervisor', 'administrator'];

        foreach ($roles as $role) {
            \App\User_Role::create([
                'role' => $role
            ]);
        }
    }
}
