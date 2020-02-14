<?php

use Faker\Generator as Faker;
use App\Cursos;

$factory->define(Cursos::class, function (Faker $faker) {
    return [
        'titulo' => $faker->unique()->name,
        'descricao' => $faker->text
    ];
});
