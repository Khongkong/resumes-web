<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Resume;
use App\User;
use App\Enums\ResumeType;
use Faker\Generator as Faker;

$factory->define(Resume::class, function (Faker $faker) {
    $userIds = array_map(function($user){
        $user->id;
    },User::all());

    return [
        'title' => $faker->realText($maxNbChars = 15),
        'content' => $faker->realText($maxNbChars = 200),
        'type' => ResumeType::English,
        'user_id' => array_rand($userIds)
    ];
});