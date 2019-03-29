<?php

use Illuminate\Database\Seeder;

class WebpagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Webpage::create([
            'name' => 'home',
        ]);
        App\Webpage::create([
            'name' => 'about',
        ]);
        App\Webpage::create([
            'name' => 'portfolio',
        ]);
        App\Webpage::create([
            'name' => 'reviews',
        ]);
        App\Webpage::create([
            'name' => 'contact',
        ]);
        App\Webpage::create([
            'name' => 'services',
        ]);
        App\Webpage::create([
            'name' => 'web_design',
        ]);
        App\Webpage::create([
            'name' => 'digital_marketing',
        ]);
        App\Webpage::create([
            'name' => 'graphics_design',
        ]);
    }
}
