<?php

use Illuminate\Database\Seeder;
use App\Pais;
class PaisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pais::firstOrCreate(['nome'=>'Brasil']);
    }
}
