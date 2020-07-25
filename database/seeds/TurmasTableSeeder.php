<?php

use Illuminate\Database\Seeder;
use App\Turma;
use App\Curso;
use App\Estado;

class TurmasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idMunicipios =Estado::where('nome','Amazonas')->get()->first()->municipios->modelKeys();
        foreach ($idMunicipios as $id) 
        {
            Turma::firstOrCreate([
                'curso_id'=> Curso::where('nome','Matemática')->get()->first()->id,
                'municipio_id'=> $id,
                'vagas'=>30
            ]);
        }

    }
}
