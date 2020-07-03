<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Documento;
use Faker\Generator as Faker;
use Faker\Provider\Base;

$factory->define(Documento::class, function (Faker $faker) {

    $estadoCivil = ['Solteiro(a)','Casado(a)','Divorciado(a)','Viuvo(a)','União Estável','Outros'];
    $tipoDocumento = ['Civil','Militar','Profissional'];
    $rand = rand(0,1);
    $sexo = [0 => ['M','male'], 1 => ['F','female']];
    $idmunicipios = App\Estado::where('nome','Amazonas')->get()->first()->municipios->modelKeys();
    $municipio = App\Municipio::find(Arr::random($idmunicipios));
    return [
        'nome' => $faker->name($sexo[$rand][1]),
        'sexo'=> $sexo[$rand][0],
        'cpf' => $faker->cpf(false),
        'nome_mae' => $faker->name('female'),
        'nome_pai' => $faker->name('male'),
        'data_nascimento' =>$faker->date('Y-m-d','2000-01-01'),
        'estado_civil' => Arr::random($estadoCivil),
        'tipo_documento' => Arr::random($tipoDocumento),
        'num_documento' => $faker->rg(false),
        'data_emissao_documento' => $faker->date('Y-m-d','1998-01-01'),
        'orgao_emissor_documento' => 'SSP',
        'uf_documento' => $municipio->estado->id,
        'nascimento_municipio' => $municipio->id,
        'titulo_num' => $faker->randomNumber(8),
        'titulo_emissao' => $faker->date('Y-m-d','2016-01-01'),
        'titulo_municipio'=> $municipio->id
    ];
});
