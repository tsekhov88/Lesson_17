<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {

	$car_brands = config('random_data.car_brands');
	$car_models = config('random_data.car_models');

    return [
        'owner_name' => $faker->firstName,
        'car_brand' => $faker->randomElement($car_brands),
        'car_model' => $faker->randomElement($car_models),
        'year' => $faker->numberBetween(1980, 2019),
        'distance' => $faker->numberBetween(10000, 50000),

    ];
});
