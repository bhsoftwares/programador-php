<?php

use App\Alunos;
use Faker\Generator as Faker;

$factory->define(Alunos::class, function (Faker $faker) {
    return [
        'nome' => $faker->unique()->name,
        'email' => $faker->unique()->email,
        'data_nasc' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});
