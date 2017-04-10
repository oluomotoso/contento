<?php

use Illuminate\Database\Seeder;

class PlatformSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['blogger', 'wordpress'];
        $i = 0;
        foreach ($roles as $role) {
            $i += 1;
            \App\Platform::create([
                'id' => $i,
                'platform' => $role
            ]);
        }
    }
}
