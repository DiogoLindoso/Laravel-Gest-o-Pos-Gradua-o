<?php

use Illuminate\Database\Seeder;
use App\Cota;
class CotasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cota::firstOrCreate(['nome'=>'SEDUC','prioridade'=>1]);
        Cota::firstOrCreate(['nome'=>'SEMED','prioridade'=>2]);
        Cota::firstOrCreate(['nome'=>'PSS','prioridade'=>3]);
    }
}
