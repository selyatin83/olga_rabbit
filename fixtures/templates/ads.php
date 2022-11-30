<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->name(),
    'imageSrc' => $faker->randomElement([
        '/img/avatar01.jpg',
        '/img/avatar02.jpg',
        '/img/avatar03.jpg',
        '/img/avatar04.jpg',
    ]),
    'typeId' => $faker->randomNumber(2, true),
    'description' => $faker->realTextBetween(50, 1000),
    'author' => $faker->randomNumber(10, true),
    'email' => $faker->email()
];
