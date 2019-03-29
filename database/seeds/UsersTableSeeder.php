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
            'name' => 'Destiny',
            'slug' => str_slug('Destiny'),
            'email' => 'destiny@24seven.co.ke',
            'phone' => '+254 723077827',
            'type' => 'supper',
            'password' => '$2y$10$/4bTCXlUYYAq78DNmFTwUugFZgKJw4/hRvAxlLKDQvParrPkWDxPS' 
        ]);

        
        App\User::create([
            'name' => 'Gien',
            'slug' => str_slug('Gien'),
            'email' => 'gien@24seven.co.ke',
            'phone' => '+254 799315478 ',
            'type' => 'supper',
            'password' => bcrypt('mihadarati')
        ]);
    }
}