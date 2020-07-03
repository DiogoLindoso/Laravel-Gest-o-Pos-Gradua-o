<?php

use Illuminate\Database\Seeder;
use App\Cota;
use App\Curso;

class CotasCursosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::where('nome','Matemática')->get()->first()->cotas()
        ->attach(Cota::where('nome','SEDUC')->get()->first()->id);
        Curso::where('nome','Matemática')->get()->first()->cotas()
        ->attach(Cota::where('nome','SEMED')->get()->first()->id);
        Curso::where('nome','Matemática')->get()->first()->cotas()
        ->attach(Cota::where('nome','PSS')->get()->first()->id);
    }
}
