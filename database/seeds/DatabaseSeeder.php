<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersRolesSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PlatformSeed::class);
    }
}
