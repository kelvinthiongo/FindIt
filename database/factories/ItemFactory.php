<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'f_name' => $faker->firstName,
        's_name' => $faker->randomElement([
            'Thiongo',
            '',
            'Mwaura',
            'Kabogo',
            'Kahiu',
            'Maina',
            'Kimani',
            'Nguli',
            'Kamau',
            'Muli',
            'Irungu',
            'Guka',
        ]),
        'l_name' => $faker->lastName                                  ,
        'category_id' => 1,
        'user_id' => 1,
        'number' => $faker->ean8,
        'place_to_get' => $faker->city,
        'place_found' => $faker->city,
    ];
});
