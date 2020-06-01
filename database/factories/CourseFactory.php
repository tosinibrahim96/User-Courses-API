<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Course;
use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text(),
        'max_students' => $faker->numberBetween(10, 20),
        'instructor_name' => $faker->name, // password
    ];
});
