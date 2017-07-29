<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
	    'condition' => rand(App\User::CONDITION_MIN, App\User::CONDITION_MAX),
    ];
});

$factory->define(App\Idea::class, function (Faker\Generator $faker) {
	return [
		'name' => ucwords($faker->name),
		'text' => $faker->text,
	];
});

$factory->define(App\Task::class, function (Faker\Generator $faker) {
	return [
		'name' => ucwords($faker->word),
		'text' => $faker->paragraph(3, true)
	];
});

$factory->define( App\Feedback::class, function ( Faker\Generator $faker ) {
	return [
		'comment' => $faker->paragraph(),
		'task_id' => 1,
		'user_id' => 1
	];
} );

$factory->define( App\Source::class, function ( Faker\Generator $faker ) {
	return [
		'name' => ucwords($faker->word),
		'description' => $faker->paragraph()
	];
});
