<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'adId' => $faker->unique()->numberBetween(1, 107),
    'categoryId' => $faker->numberBetween(1, 6),
];
