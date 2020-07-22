<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PaisesTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(MunicipiosTableSeeder::class);
        $this->call(CotasTableSeeder::class);
        $this->call(CursosTableSeeder::class);
        $this->call(CotasCursosTableSeeder::class);
        $this->call(TurmasTableSeeder::class);
        $this->call(UsersTestTableSeeder::class);
    }
    
}
