<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Field;
use App\Models\Subscriber;
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

$factory->define(Field::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'type' => $faker->randomElement([
            Field::TYPE_BOOLEAN,
            Field::TYPE_DATE,
            Field::TYPE_NUMBER,
            Field::TYPE_STRING,
        ]),
         'subscriber_id' => Subscriber::pluck('id')->random(),
    ];
});
