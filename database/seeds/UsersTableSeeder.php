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
            'email_verified_at' => now(),
            'is_verified' => true,
            'phone' => '+254 723077827',
            'type' => 'supper',
            'password' => '$2y$10$/4bTCXlUYYAq78DNmFTwUugFZgKJw4/hRvAxlLKDQvParrPkWDxPS' //@destiny
        ]);

        
        App\User::create([
            'name' => 'Gien',
            'slug' => str_slug('Gien'),
            'email_verified_at' => now(),
            'email' => 'gien@24seven.co.ke',
            'is_verified' => true,
            'phone' => '+254 799315478 ',
            'type' => 'supper',
            'password' => bcrypt('mihadarati')
        ]);
        
        App\User::create([
            'name' => 'Dennis Kabogo',
            'slug' => str_slug('Dennis Kabogo'),
            'email' => 'kabogo@24seven.co.ke',
            'is_verified' => true,
            'email_verified_at' => now(),
            'phone' => '+254 713752124',
            'type' => 'ordinary',
            'password' => bcrypt('@findit')
        ]);

        App\User::create([
            'name' => 'Denis Kimani',
            'slug' => str_slug('Denis Kimani'),
            'email' => 'kimani@24seven.co.ke',
            'is_verified' => true,
            'email_verified_at' => now(),
            'phone' => '+254 714074353',
            'type' => 'ordinary',
            'password' => bcrypt('@findit')
        ]);

        
        App\User::create([
            'name' => 'Charles Irungu',
            'slug' => str_slug('Charles Irungu'),
            'email_verified_at' => now(),
            'email' => 'charles@24seven.co.ke',
            'is_verified' => true,
            'phone' => '+254 714850187 ',
            'type' => 'ordinary',
            'password' => bcrypt('@findit')
        ]);
        App\User::create([
            'name' => 'Mwaura George',
            'slug' => str_slug('Mwaura George'),
            'email_verified_at' => now(),
            'is_verified' => true,
            'email' => 'me@24seven.co.ke',
            'phone' => '+25471829989',
            'is_verified' => true,
            'password' => bcrypt('@24seven')
        ]);
    }
}