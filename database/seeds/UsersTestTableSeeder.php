<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Admin;
class UsersTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(['email'=>'diogolindoso@gmail.com', 'password'=>bcrypt('diogo123')]);
        Admin::firstOrCreate(['name'=>'Admin', 'email'=>'diogolindoso@gmail.com', 'password'=>bcrypt('diogo123')]);

        factory(App\User::class,4000)->create()->each(function($user)
        {
            $endereco = factory(App\Endereco::class)->make();
            $documento = factory(App\Documento::class)->make();
            $inscricao = factory(App\Inscricao::class)->make();

            $inscricao->turma_id = App\Turma::where('municipio_id',$endereco->municipio_id)->first()->id;

            $user->endereco()->save($endereco);
            $user->documento()->save($documento);
            $user->inscricao()->save($inscricao);
        });
    }
}
