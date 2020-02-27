<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'name' => $faker->name,
        'state' => $faker->randomElement([
            Subscriber::STATE_ACTIVE,
            Subscriber::STATE_BOUNCED,
            Subscriber::STATE_JUNK,
            Subscriber::STATE_UNCONFIRMED,
            Subscriber::STATE_UNSUBSCRIBED,
        ]),
    ];
});
