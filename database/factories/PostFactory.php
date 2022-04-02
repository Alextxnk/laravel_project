<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $title = $faker->realText(rand(10, 40));
    $short_title = mb_strlen($title)>30 ? mb_substr($title, 0, 30) . '...' : $title; // Тернарный оператор - если длина $title > 30, то ставим ... после 30 символа (обрезаем строку),  если нет (< 30) то оставляем $title
    $created = $faker->dateTimeBetween('- 30 days', '-1 days'); // пост рандомно будет создан либо 30 дней назад ... 1 день назад

    return [
        'title' => $title,
        'short_title' => $short_title,
        'author_id' => rand(1, 4),
        'description' => $faker->realText(rand(100, 500)),
        'created_at' => $created,
        'updated_at' => $created,
    ];
});
