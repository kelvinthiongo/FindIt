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
        App\User::create([
            'name' => 'Developer@test',
            'slug' => str_slug('Developer@test'),
            'email' => 'info@24seven.co.ke',
            'email_verified_at' => now(),
            'is_verified' => true,
            'phone' => '+254 7XX XXXXXX',
            'type' => 'super',
            'view' => false,
            'password' => bcrypt('@24seven')
        ]);
        App\User::create([
            'name' => 'JKUAT Admin',
            'slug' => str_slug('JKUAT Admin'),
            'email' => 'admin@jkuat.ac.ke',
            'email_verified_at' => now(),
            'is_verified' => true,
            'phone' => '+254 7XX XXXXXX',
            'type' => 'super',
            'view' => false,
            'password' => bcrypt('@jkuatlost')
        ]);

    }
}
