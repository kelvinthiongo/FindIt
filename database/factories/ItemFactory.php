<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    $category = $faker->randomElement([
        'National ID',
        'School ID',
        'Others',
    ]);
    if($category == 'School ID')
        $category_id = 1;
    else if($category == 'National ID')
        $category_id = 2;
    else
        $category_id = 3;
    return [
        'name' => $faker->randomElement([
            $faker->firstName . ' Thiongo',
            $faker->firstName . ' Lucy',
            $faker->firstName . ' Mwaura',
            $faker->firstName . ' Kabogo',
            $faker->firstName . ' Kahiu',
            $faker->firstName . ' Maina',
            $faker->firstName . ' Kimani',
            $faker->firstName . ' Nguli',
            $faker->firstName . ' Kamau',
            $faker->firstName . ' Muli',
            $faker->firstName . ' Irungu',
            $faker->firstName . ' Omondi',
            $faker->firstName . ' Kipchoge',
            $faker->firstName . ' Ghati',
            $faker->firstName . ' Murugi',
            $faker->firstName . ' Atieno',
            $faker->firstName . ' Hamadi',
            $faker->firstName . ' Uhuru',
            $faker->firstName . ' Ruto',
            $faker->firstName . ' Nganga',
            $faker->firstName . ' Katelo',
            $faker->firstName . ' Kimari',
            $faker->firstName . ' James',
            $faker->firstName . ' Martin',
            $faker->firstName . ' Obama',
            $faker->firstName . ' King',
            $faker->firstName . ' Wangui',
            $faker->firstName . ' Kungu',
            $faker->firstName . ' Simple Boy',
            $faker->firstName . ' Cute',
            $faker->firstName . ' Njeri',
            $faker->firstName . ' Hamisi',
            $faker->firstName . ' Mugenda',
            $faker->firstName . ' Waititu',
            $faker->firstName . ' Kabogo',
            $faker->firstName . ' Sonko',
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
            $faker->firstName . ' '  . $faker->lastName,
        ]),
        'category' => $category,
        'category_id' => $category_id,
        'number' => $faker->ean8,
        'collection_point' => $faker->randomElement([
            'JKUAT Main Campus: Customer Care',
        ]),
    ];
});
