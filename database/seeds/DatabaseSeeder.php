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
        $this->call(UsersTestTableSeeder::class);
        $this->call(CotasTableSeeder::class);
        $this->call(CursosTableSeeder::class);
        $this->call(CotasCursosTableSeeder::class);
        $this->call(TurmasTableSeeder::class);

        factory(App\User::class,4000)->create()->each(function($user){
            $user->endereco()->save(factory(App\Endereco::class)->make());
            $user->documento()->save(factory(App\Documento::class)->make());
            $user->inscricao()->save(factory(App\Inscricao::class)->make());
        });
    }
    
}
