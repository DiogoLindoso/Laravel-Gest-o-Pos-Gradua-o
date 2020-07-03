<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Inscricao;
use Faker\Generator as Faker;

$factory->define(Inscricao::class, function (Faker $faker) {
        $idcota = App\Cota::all()->modelKeys();
        $idcurso = App\Curso::all()->modelKeys();
        $idturma = App\Turma::all()->modelKeys();
    return [
        'cota_id' => Arr::random($idcota),
        'curso_id' => Arr::random($idcurso),
        'turma_id' => Arr::random($idturma),
        'tempo_servico_dias' => $faker->numberBetween(365,10950),
        'compravante_tempo_servico' => ''
    ];
});
