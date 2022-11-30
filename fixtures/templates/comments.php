<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'author' => $faker->randomNumber(10, true),
    'adId' => $faker->randomNumber(50, true),
    'text' => $faker->realTextBetween(20, 500),
];
