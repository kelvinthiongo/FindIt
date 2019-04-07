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
        $items = [ 
            'School ID',  'National ID',  'NHIF', 'name' => 'NSSF', 'Passport', 'ATM Card', 'Log book', 'Driving Licence', 'Birth certificate', 'Education certificate', 'Others',
        ];

        foreach($items as $item){
             App\Category::create([
                'name' => $item,
                'slug' => str_slug($item),
            ]);
        }
    }
}
