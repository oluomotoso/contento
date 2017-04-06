<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
            'name'=>'Femtosh Global Solutions', 'email' => 'info@femtosh.com', 'password' => bcrypt('@wearefemtosh'), 'user_role_id' => 5
        ]);
    }
}
