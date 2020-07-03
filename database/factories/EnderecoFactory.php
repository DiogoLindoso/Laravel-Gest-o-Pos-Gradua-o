<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Endereco;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Endereco::class, function (Faker $faker) {
    $idmunicipios = App\Estado::where('nome','Amazonas')->get()->first()->municipios->modelKeys();
    //$municipio = App\Municipio::find(Arr::random($idmunicipios))->nome;
    return [
        'municipio_id'=> Arr::random($idmunicipios),
        'cep'=> $faker->numberBetween(69000000,69099999),
        'logradouro'=>$faker->streetName,
        'bairro'=>$faker->word,
        'num'=>$faker->buildingNumber,
        'complemento'=> rand(0,1)? $faker->word : "",
        'celular'=>'92991090487',
        'telefone_fixo'=>'9236514657'
    ];
});
