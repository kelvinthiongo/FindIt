<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::create([
            'name' => 'School ID',
        ]);
        
        App\Category::create([
            'name' => 'National ID',
        ]);


        App\Category::create([
            'name' => 'NHIF',
        ]);


        App\Category::create([
            'name' => 'NSSF',
        ]);


        App\Category::create([
            'name' => 'Passport',
        ]);


        App\Category::create([
            'name' => 'ATM Card',
        ]);


        App\Category::create([
            'name' => 'Log book',
        ]);


        App\Category::create([
            'name' => 'Driving Licence',
        ]);


        App\Category::create([
            'name' => 'Birth certificate',
        ]);

        App\Category::create([
            'name' => 'Education certificate',
        ]);

        App\Category::create([
            'name' => 'Others',
        ]);

    }
}
