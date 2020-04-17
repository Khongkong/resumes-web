<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $resumes = App\Resume::all();
    return [
        'content' => $faker->realText($maxNbChars = 40),
        'resume_id' => $resumes->pluck('id')->random()
    ];
});
